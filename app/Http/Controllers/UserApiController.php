<?php

namespace App\Http\Controllers;

use App\User;

class UserApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('cors');
    }
    public function users()
    {
        $users = User::all();
        return $users;
    }
}
