<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class ManageBookingController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = 'All Bookings';

     
        return view('admin.bookings.index',compact('pageTitle'));
    }

  
}
