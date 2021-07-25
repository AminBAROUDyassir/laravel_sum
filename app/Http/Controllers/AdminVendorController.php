<?php

namespace App\Http\Controllers;

use App\User;
use App\UserInfo;
use App\Vendor;
use App\VendorUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminVendorController extends Controller
{
    public function index(Request $request)
    {

        $vendors = Vendor::where('type', 'V')->leftjoin('user_info', 'users.id', '=', 'user_info.user_id')->select('users.id as user_id',
            'user_info.first_name as firstname',
            'user_info.last_name as lastname',
            'users.email as email',
            'user_info.phone',
            'user_info.address',
            'users.status',
            'user_info.created_at')->get();

        return view('admin.vendor.index', ["vendors" => $vendors]);
    }
    public function add()
    {
        $new = true;

        return view("admin.vendor.add", ["new" => $new]);

    }

    public function add_vendor(Request $request)
    {

        try {

            if ($request->user_id) {
                $User = user::find($request->user_id);

                $User->name = $request->name;
                $User->email = $request->email;
                if (isset($request->password)) {
                    $User->password = Hash::make($request->password);
                }

                $User->save();

                $UserInfo = UserInfo::where('user_id', $request->user_id)->first();
                $UserInfo->user_id = $User->id;
                $UserInfo->first_name = $request->firstname;
                $UserInfo->last_name = $request->lastname;
                $UserInfo->address = $request->address;
                $UserInfo->phone = $request->phone;
                $UserInfo->save();

                return redirect()->route('vendors');

            } else {

                $expire_date = time() + 30 * 24 * 3600;
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'token' => Hash::make(rand() . time() . rand()),
                    'type' => 'V',
                    'token_expiry' => date('Y/m/d H:i:s', $expire_date),
                    'password' => Hash::make($request->password),
                ]);

                $UserInfo = new UserInfo();
                $UserInfo->user_id = $user->id;
                $UserInfo->first_name = $request->firstname;
                $UserInfo->last_name = $request->lastname;
                $UserInfo->address = $request->address;
                $UserInfo->phone = $request->phone;
                $UserInfo->save();
                return redirect()->route('vendors');
            }

        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

    }

    public function edit($vendor_id)
    {

        $new = false;

        $vendor = Vendor::where('type', 'V')->where('users.id', $vendor_id)->leftjoin('user_info', 'users.id', '=', 'user_info.user_id')->select('users.id as user_id',
            'user_info.first_name as firstname',
            'user_info.last_name as lastname',
            'users.email as email',
            'user_info.phone',
            'users.name',
            'user_info.address',
            'users.status',
            'user_info.created_at')->first();

        return view('admin.vendor.edit', ["vendor" => $vendor, "new" => $new, "user_id" => $vendor_id]);

    }

    public function delete($vendor_id)
    {

        try {
            $user = User::where('id', $vendor_id)->delete();
            UserInfo::where('user_id', $vendor_id)->delete();
            return redirect()->route('vendors');
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

    }

    public function activate($vendor_id)
    {
        try {
            $user = User::where('id', $vendor_id)->first();
            $user->status = 1;
            $user->save();
            return redirect()->route('vendors');
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function desactivate($vendor_id)
    {

        try {
            $user = User::where('id', $vendor_id)->first();
            $user->status = 0;
            $user->save();
            return redirect()->route('vendors');
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function vendor_users($vendor_id)
    {

        \Session::put('vendor_id', $vendor_id);

        $vendor = Vendor::where('type', 'V')->where('users.id', $vendor_id)->leftjoin('user_info', 'users.id', '=', 'user_info.user_id')->select('users.id as user_id',
            'user_info.first_name as firstname',
            'user_info.last_name as lastname',
            'users.email as email',
            'user_info.phone',
            'users.name',
            'user_info.address',
            'users.status',
            'user_info.created_at')->first();

        $VendorUser = VendorUser::where('vendor_id', $vendor_id)->
            leftjoin('users', 'users.id', '=', 'vendor_users.user_id')->
            leftjoin('user_info', 'user_info.user_id', '=', 'vendor_users.user_id')->
            select('users.id as user_id',
            'user_info.first_name as firstname',
            'user_info.last_name as lastname',
            'users.email as email',
            'user_info.phone',
            'user_info.address',
            'users.status',
            'user_info.created_at')->
            get();
        return view('admin.vendor.users.index', ["VendorUser" => $VendorUser, "vendor" => $vendor]);

    }

    public function add_vendor_users()
    {

        $new = true;

        return view('admin.vendor.users.add', ["new" => $new]);
    }

    public function add_vendor_users_save(Request $request)
    {
        try {

            $vendor_id = \Session::get('vendor_id');

            if ($request->user_id) {
                $User = user::find($request->user_id);

                $User->name = $request->name;
                $User->email = $request->email;
                if (isset($request->password)) {
                    $User->password = Hash::make($request->password);
                }

                $User->save();

                $UserInfo = UserInfo::where('user_id', $request->user_id)->first();
                $UserInfo->user_id = $User->id;
                $UserInfo->first_name = $request->firstname;
                $UserInfo->last_name = $request->lastname;
                $UserInfo->address = $request->address;
                $UserInfo->phone = $request->phone;
                $UserInfo->save();

                return redirect()->route('vendor_users', ['id' => $vendor_id]);

            } else {

                $expire_date = time() + 30 * 24 * 3600;
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'token' => Hash::make(rand() . time() . rand()),
                    'tyep' => 'C',
                    'token_expiry' => date('Y/m/d H:i:s', $expire_date),
                    'password' => Hash::make($request->password),
                ]);

                $UserInfo = new UserInfo();
                $UserInfo->user_id = $user->id;
                $UserInfo->first_name = $request->firstname;
                $UserInfo->last_name = $request->lastname;
                $UserInfo->address = $request->address;
                $UserInfo->phone = $request->phone;
                $UserInfo->save();

                $VendorUser = new VendorUser();
                $VendorUser->user_id = $user->id;
                $VendorUser->vendor_id = $vendor_id;
                $VendorUser->save();

                return redirect()->route('vendor_users', ['id' => $vendor_id]);
            }

        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function edit_vendor_users($user_id)
    {

        $new = false;

        $user = User::where('type', 'C')->where('users.id', $user_id)->leftjoin('user_info', 'users.id', '=', 'user_info.user_id')->select('users.id as user_id',
            'user_info.first_name as firstname',
            'user_info.last_name as lastname',
            'users.email as email',
            'user_info.phone',
            'users.name',
            'user_info.address',
            'users.status',
            'user_info.created_at')->first();

        return view('admin.vendor.users.edit', ["user" => $user, "new" => $new, "user_id" => $user_id]);

    }

    public function delete_vendor_users($user_id)
    {

        try {
            $user = User::where('id', $user_id)->delete();
            UserInfo::where('user_id', $user_id)->delete();
            VendorUser::where('user_id', $user_id)->delete();
            $vendor_id = \Session::get('vendor_id');
            return redirect()->route('vendor_users', ['id' => $vendor_id]);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

    }

    public function activate_vendor_users($user_id)
    {
        try {
            $user = User::where('id', $user_id)->first();
            $user->status = 1;
            $user->save();
            $vendor_id = \Session::get('vendor_id');
            return redirect()->route('vendor_users', ['id' => $vendor_id]);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function desactivate_vendor_users($user_id)
    {

        try {
            $user = User::where('id', $user_id)->first();
            $user->status = 0;
            $user->save();
            $vendor_id = \Session::get('vendor_id');
            return redirect()->route('vendor_users', ['id' => $vendor_id]);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

}
