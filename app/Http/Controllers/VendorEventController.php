<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventVendor;
use App\Helpers\Helper;
use App\Vendor;
use Illuminate\Http\Request;

class VendorEventController extends Controller
{
    public function index()
    {
        $EventInfo = Event::leftjoin('event_vendor', 'event.event_id', '=', 'event_vendor.event_id')->
            leftjoin('user_info', 'user_info.user_id', '=', 'event_vendor.vendor_id')->
            select('event.event_id', 'event.name', 'event.date_event', 'event.message_event', 'event.picture_event', 'event.nbr', 'event.status', 'user_info.first_name', 'user_info.last_name', 'event_vendor.vendor_id')->get();

        foreach ($EventInfo as $Event) {
            $Event->picture_event = Helper::get_url_picture($Event->picture_event, "/uploads/");
        }

        return view("vendor.event.index", ["event_info" => $EventInfo]);
    }

    public function add()
    {
        return view("vendor.event.add");
    }

    public function add_event(Request $request)
    {

        try {

            if ($request->event_id) {
                $event = Event::where('event_id', $request->event_id)->first();
                $event->name = $request->name;
                $event->date_event = $request->date_event;
                $event->message_event = $request->message_event;

                Helper::delete_picture($event->picture_event, "/uploads/");

                if ($request->hasFile('picture_event')) {

                    $image = Helper::upload_picture($request->picture_event);

                    $event->picture_event = $image;
                }

                $event->nbr = $request->nbr;
                $event->save();

                return redirect()->route('events');

            } else {

                $event = new Event();
                $event->name = $request->name;
                $event->date_event = $request->date_event;
                $event->message_event = $request->message_event;
                if ($request->hasFile('picture_event')) {

                    $image = Helper::upload_picture($request->picture_event);

                    $event->picture_event = $image;
                }
                $event->nbr = $request->nbr;
                $event->save();
                return redirect()->route('events');
            }

        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

    }

    public function edit($event_id)
    {

        $EventInfo = Event::where('event.event_id', $event_id)->leftjoin('event_vendor', 'event.event_id', '=', 'event_vendor.event_id')->
            leftjoin('user_info', 'user_info.user_id', '=', 'event_vendor.vendor_id')->
            select('event.event_id', 'event.name', 'event.date_event', 'event.message_event', 'event.picture_event', 'event.nbr', 'event.status', 'user_info.first_name', 'user_info.last_name')->first();
        $date = $EventInfo->date_event;
        $date = explode(" ", $date);

        $EventInfo->picture_event = Helper::get_url_picture($EventInfo->picture_event, "/uploads/");

        $EventInfo->date_event = $date[0];

        return view('vendor.event.edit', ["event" => $EventInfo, "event_id" => $event_id]);

    }

    public function delete($event_id)
    {

        try {
            $event = Event::where('event_id', $event_id)->delete();
            return redirect()->route('events');
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

    }

    public function activate($event_id)
    {
        try {
            $Event = Event::where('event_id', $event_id)->first();
            $Event->status = 1;
            $Event->save();
            return redirect()->route('events');
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function desactivate($event_id)
    {

        try {
            $Event = Event::where('event_id', $event_id)->first();
            $Event->status = 0;
            $Event->save();
            return redirect()->route('events');
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function link($event_id)
    {
        $array = array();

        \Session::put('event_id', $event_id);

        $vendors = Vendor::where('type', 'V')->leftjoin('user_info', 'users.id', '=', 'user_info.user_id')->select('users.id as user_id',
            'user_info.first_name as firstname',
            'user_info.last_name as lastname',
            'users.email as email',
            'user_info.phone',
            'user_info.address',
            'users.status',
            'user_info.created_at')->get();

        $event = Event::where('event_id', $event_id)->first();

        return view("vendor.event.link", ["vendors" => $vendors, 'event' => $event, 'event_id' => $event_id]);
    }

    public function change($event_id)
    {

        \Session::put('event_id', $event_id);

        $vendors = Vendor::where('type', 'V')->leftjoin('user_info', 'users.id', '=', 'user_info.user_id')->select('users.id as user_id',
            'user_info.first_name as firstname',
            'user_info.last_name as lastname',
            'users.email as email',
            'user_info.phone',
            'user_info.address',
            'users.status',
            'user_info.created_at')->get();

        $EventVendor = EventVendor::where('event_id', $event_id)->first();
        $vendor_id = $EventVendor->vendor_id;

        $event = Event::where('event_id', $event_id)->first();

        return view("vendor.event.link", ["vendors" => $vendors, 'event' => $event, 'event_id' => $event_id, 'vendor_id' => $vendor_id]);
    }

    public function link_save(Request $request)
    {
        $event_id = \Session::get('event_id');
        if (isset($request->vendor_change)) {
            $EventVendor = EventVendor::where("vendor_id", $request->vendor_change)->where("event_id", $request->event_id)->first();
        } else {
            $EventVendor = new EventVendor();
        }
        $EventVendor->vendor_id = $request->vendor_id;
        $EventVendor->event_id = $event_id;
        $EventVendor->save();

        return redirect()->route('events');
    }

}
