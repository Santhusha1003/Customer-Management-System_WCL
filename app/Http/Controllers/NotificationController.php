<?php

namespace App\Http\Controllers;

use App\Support\SampleNotifications;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function index(): View
    {
        $notifications = SampleNotifications::all();

        return view('notifications.index', compact('notifications'));
    }
}
