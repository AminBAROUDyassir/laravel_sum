<?php

namespace App\Http\Controllers;

use Auth;

class AdminHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = array();
        return view('admin.manage.index', ["users" => $users]);
    }

    public function home()
    {
        $role = Auth::user()->type;

        info("----------- info user start ---------");
        info($role);
        info("----------- info user end ---------");
        switch ($role) {
            case "A":
                return redirect()->route('admin_index');
                break;
            case "V":
                return redirect()->route('vendor_index');
                break;

            default:
                return redirect()->route('login');
                break;
        }
    }
}
