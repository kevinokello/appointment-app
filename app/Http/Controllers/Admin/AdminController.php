<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Category;

use App\Models\GeneralSetting;

use App\Models\Service;

use App\Models\User;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function home()
    {
        $pageTitle = 'Admin Dashboard';

        $totalUser = User::where('user_type', 1)->count();
        $totalProvider = User::where('user_type', 2)->count();
        $totalService = Service::count();
        $totalBookings = Appointment::count();
        $providers = User::where('user_type', 2)->paginate(10);
        $users = User::where('user_type', 1)->paginate(10);


        return view('admin.dashboard', compact('pageTitle', 'totalUser', 'totalProvider', 'totalService', 'totalBookings', 'providers', 'users'));
    }

    public function profile()
    {
        $pageTitle = 'Profile';

        return view('admin.profile', compact('pageTitle'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'username' => 'required',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png'
        ]);

        $admin = auth()->guard('admin')->user();

        if ($request->has('image')) {

            $filename = uploadImage($request->image, filePath('profile'),$admin->image);

            $admin->image = $filename;
        }


        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->save();


        $notify[] = ['success', 'Admin Profile Update Success'];

        return redirect()->back()->withNotify($notify);
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed'
        ]);

        $admin = auth()->guard('admin')->user();

    

        $admin->password = bcrypt($request->password);
        $admin->save();


        $notify[] = ['success', 'Password changed Successfully'];

        return back()->withNotify($notify);
    }



   

}
