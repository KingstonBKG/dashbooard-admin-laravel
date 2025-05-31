<?php

namespace App\Http\Controllers\tontiflex\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
  public function index()
  {
    return view('pages.dashboard.analytics.dashboard-analytics');
  }
}
