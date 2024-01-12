<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Notification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        return inertia(
            'Notification/Index',
            [
                'notifications' => $request->user()->notifications()->paginate(7)
            ]
        );
    }

    public function delete(Request $request)
    {
        DatabaseNotification::where('notifiable_id', $request->user()->id)->delete();
        return redirect()->back()->with('success', 'All Notifications was deleted');
    }
}
