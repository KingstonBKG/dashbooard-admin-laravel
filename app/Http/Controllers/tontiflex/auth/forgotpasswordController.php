<?php

namespace App\Http\Controllers\tontiflex\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class forgotpasswordController extends Controller
{
    public function index()
    {
        return view('pages.auth.auth-forgot-password');
    }
}
