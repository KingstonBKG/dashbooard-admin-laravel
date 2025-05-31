<?php

namespace App\Http\Controllers\tontiflex\tontineview;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TontineViewController extends Controller
{
    public function index()
    {
        return view('pages.tontine-view.main.index-tontine-main');
    }
}
