<?php

namespace App\Http\Controllers\tontiflex\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
  public function index()
  {
    $calendrier = [
        [
            'date' => '2025-06-10',
            'user' => [
                'name' => 'Alice',
                'photo' => asset('storage/avatars/alice.jpg')
            ]
        ],
        [
            'date' => '2025-06-17',
            'user' => [
                'name' => 'Bob',
                'photo' => asset('storage/avatars/bob.jpg')
            ]
        ],
        // ...
    ];
    return view('pages.dashboard.analytics.dashboard-analytics', compact('calendrier'));
  }
}
