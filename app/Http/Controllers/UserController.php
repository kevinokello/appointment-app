<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Nette\Utils\Random;
use Purifier;

class UserController extends Controller
{
    public function dashboard()
    {
        $pageTitle = 'DashBoard';

        $user = auth()->user();

        if ($user->user_type == 2) {
            $service = $user->services->count();

            $serve = Service::where('user_id', $user->id)->pluck('id')->toArray();            

            $services = Service::where('user_id', $user->id)->paginate(10);


            $bookings = Booking::whereHas('service',function($q){$q->where('user_id',auth()->id());})->latest()->with('user', 'service')->paginate(10);

            return view('frontend.user.dashboard', compact('pageTitle', 'service', 'services','bookings'));
        }

        $booking = Booking::where('user_id', $user->id)->count();
        $bookingPending = Booking::where('user_id', $user->id)->where('is_accepted', 0)->count();
        $bookingComplete = Booking::where('user_id', $user->id)->where('is_completed', 1)->count();
     
        $bookings = Booking::whereHas('service')->where('user_id', $user->id)->latest()->paginate();


        return view('frontend.user.dashboard', compact('pageTitle', 'booking', 'bookingPending', 'bookingComplete','bookings'));
    }

    public function profile()
    {
        $pageTitle = 'Profile Setting';

        $user = auth()->user();

        return view('frontend.user.profile', compact('pageTitle', 'user'));
    }

    public function profileUpdate(Request $request)
    {

        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'mobile' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'address' => 'required',
            'image' => 'sometimes|image|mimes:jpg,png,jpeg',
            'designation' => 'sometimes|required',
            'details' => 'sometimes|required|',
            'experience' => 'sometimes|required'

        ], [
            'fname.required' => 'First Name is required',
            'lname.required' => 'Last Name is required',

        ]);

        // $user = auth()->user();

        // if ($request->hasFile('image')) {
        //     $filename = uploadImage($request->image, filePath('user'), $user->image);
        //     $user->image = $filename;
        // }
        $user = auth()->user();

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/users/', $filename);
            $user->image = $filename;
        }
        $address = [
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'address' => $request->address
        ];

        if ($user->user_type == 2) {
            $user->designation = $request->designation;
            $user->details =  Purifier::clean($request->details);
            $user->experience =  Purifier::clean($request->experience);
 
        }

        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->mobile = $request->mobile;
        $user->address = $address;

        $user->save();


        $notify[] = ['success', 'Successfully Updated Profile'];

        return back()->withNotify($notify);
    }

    public function changePassword()
    {
        $pageTitle = "Change Password";

        return view('frontend.user.change_password', compact('pageTitle'));
    }

    public function changePasswordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed'
        ]);

        $user = auth()->user();

       
        $user->password = bcrypt($request->password);
        $user->save();


        $notify[] = ['success', 'Password changed Successfully'];

        return back()->withNotify($notify);
    }


}
