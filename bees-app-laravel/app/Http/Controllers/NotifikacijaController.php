<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikacijaController extends Controller
{
    public function read($id)
    {

        $notification = request()->user()->notifications()->where('id', $id)->get();

        $notification->markAsRead();

        return response()->json([
            'message' => 'Notifikacija označena kao pročitana.',
            'notifikacija' => $notification
        ]);
    }


    public function showAll()
    {
        $notifications = request()->user()->notifications()->get();
        return response()->json($notifications);
    }

    
}
