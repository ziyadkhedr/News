<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        auth()->user()->unreadNotifications->markAsRead();
        return view('frontend.dashboard.notification');
    }
    public function delete(Request $request){
        $notification = auth()->user()->notifications()->where('id', $request->notify_id)->first();
        if(!$notification){
            return redirect()->back()->with('error','Notification not found');
        }
        $notification->delete();
        return redirect()->back()->with('success','Notification Deleted');
    }
    public function deleteAll(){
        auth()->user()->notifications()->delete();
        return redirect()->back()->with('success','All Notifications Deleted');
}
public function markread(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back()->with('success','All Notifications Mark as Read');
}
}
