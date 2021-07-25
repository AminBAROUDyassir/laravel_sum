<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Event;
use App\Helpers\Helper;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorCouponController extends Controller
{
    public function edit($id)
    {

        $coupon = Coupon::find($id);
        return view('vendor.coupon.edit', ["coupon" => $coupon, "coupon_id" => $id]);

    }

    public function update(Request $request)
    {

        try {
            $email = $request->email;
            $coupon_id = $request->coupon_id;

            $coupon = Coupon::find($coupon_id);

            $event = Event::where('event_id', $coupon->event_id)->first();
            $event->picture_event = Helper::get_url_picture($event->picture_event, "/uploads/");

            $event->picture_path = Helper::get_path_picture($event->picture_event, "/uploads/");

            $details = [
                'title' => 'Mail from ItSolutionStuff.com',
                'body' => $event->message_event,
                'picture' => $event->picture_event,
                'barcode' => $coupon->code,
                'path' => $event->picture_path,
            ];

            info($details);
            $subject = "For the event of ";

            if (isset($request->email)) {
                \Mail::to($email)->send(new SendMail($details, $subject));
            }

            $coupon->email = $email;
            $coupon->payed = $request->payed;
            if ($request->payed == 0) {
                $coupon->payed_date = null;
            } else {
                $coupon->payed_date = now();
            }

            $coupon->save();

            //dd("Email is Sent.");

            return redirect()->route('vendor_coupons', ['id' => $coupon->event_id]);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

    }

    public function delete($id)
    {

        $event_id = \Session::get('event_id');

        try {
            $coupon = Coupon::where('id', $id)->delete();
            return redirect()->route('vendor_coupons', ['id' => $event_id]);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

    }

    public function activate($id)
    {
        try {

            $event_id = \Session::get('event_id');

            $coupon = Coupon::where('id', $id)->first();
            $coupon->activated_by = Auth::user()->name;
            $coupon->activated_date = now();
            $coupon->status = 1;
            $coupon->save();
            return redirect()->route('vendor_coupons', ['id' => $event_id]);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function notpay($id)
    {
        try {

            $event_id = \Session::get('event_id');
            $coupon = Coupon::where('id', $id)->first();
            $coupon->payed = 0;
            $coupon->payed_date = null;
            $coupon->save();
            return redirect()->route('vendor_coupons', ['id' => $event_id]);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function pay($id)
    {
        try {

            $event_id = \Session::get('event_id');
            $coupon = Coupon::where('id', $id)->first();
            $coupon->payed = 1;
            $coupon->payed_date = now();
            $coupon->save();
            return redirect()->route('vendor_coupons', ['id' => $event_id]);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function desactivate($id)
    {

        try {

            $event_id = \Session::get('event_id');
            $coupon = Coupon::where('id', $id)->first();
            $coupon->activated_by = Auth::user()->name;
            $coupon->activated_date = now();
            $coupon->status = 0;
            $coupon->save();
            return redirect()->route('vendor_coupons', ['id' => $event_id]);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function coupon($event_id)
    {

        $event = Event::where('event_id', $event_id)->first();

        $coupons = Coupon::where('event_id', $event_id)->get();

        if ($event->coupon == 0 || count($coupons) == 0) {
            for ($i = 0; $i < $event->nbr; $i++) {

                $Coupon = new Coupon();
                $Coupon->event_id = $event_id;
                $Coupon->code = "YMC-" . rand();
                $Coupon->status = 0;
                $Coupon->save();
            }

            $event->coupon = 1;
            $event->save();

        }
        \Session::put('event_id', $event_id);

        $coupons = Coupon::where('event_id', $event_id)->get();

        return view("vendor.event.coupon", ["coupons" => $coupons]);

    }

    public function get_coupon($code)
    {
        info("-------- data from code start -------------");
        info($code);
        info("-------- data from code end -------------");
        try {
            $coupon = Coupon::where('code', $code)->leftjoin('event', 'coupons.event_id', '=', 'event.event_id')
                ->select('coupons.id as coupon_id',
                    'coupons.email',
                    'coupons.code',
                    'coupons.status as coupon_status',
                    'coupons.activated_by',
                    'coupons.activated_date',
                    'event.name as name_event',
                    'event.date_event',
                    'event.message_event',
                    'event.picture_event',
                    'event.status as status_event', )->first();
            info("-------- data from coupon start -------------");
            info($coupon);
            info("-------- data from coupon end -------------");
            if ($coupon != null) {
                $coupon->picture_event = Helper::get_url_picture($coupon->picture_event, "/uploads/");
                $response_array = ['success' => true, 'data' => $coupon, 'code' => "100"];
                return response()->json($response_array);
            } else {
                $response_array = ['success' => false, 'error_messages' => 'no data', 'error_code' => "404"];

                return response()->json($response_array);
            }

        } catch (Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $error_messages, 'error_code' => $error_code];

            return response()->json($response_array);

        }

    }

    public function update_coupon(Request $request)
    {

        try {
            $coupon = Coupon::where('id', $request->coupon_id)->first();

            info("coupon _id  :" . $request->coupon_id);
            info($request);
            if ($coupon == null) {
                $response_array = ['success' => false, 'error_messages' => 'no data', 'error_code' => "404"];

                return response()->json($response_array);
            }
            $coupon->activated_by = $request->email;
            $coupon->activated_date = now();

            if ($coupon->status == 1) {
                $response_array = ['success' => false, 'error_messages' => "coupon is already activated !!!!", 'error_code' => "405"];

                return response()->json($response_array);
            }
            $coupon->status = 1;
            $coupon->save();

            $response_array = ['success' => true, 'data' => "coupon was update with success !!!!", 'code' => "101"];

            return response()->json($response_array);

        } catch (Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $error_messages, 'error_code' => $error_code];

            return response()->json($response_array);

        }

    }

}
