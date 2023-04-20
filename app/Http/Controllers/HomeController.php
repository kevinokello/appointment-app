<?php

namespace App\Http\Controllers;


use App\Models\Booking;
use App\Models\Category;
use App\Models\Page;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\AppointmentService;
use Carbon\CarbonPeriod;
use Purifier;

class HomeController extends Controller
{
    public function index()
    {
        $pageTitle = 'Home';
        return view('frontend.home',compact('pageTitle' ));
    }



    public function userDetails($user)
    {
       
        $user = User::where('slug',$user)->firstOrFail();

        $pageTitle ="{$user->fullname}";

        $services = $user->services()->where('status',1)->where('admin_approval',1)->get();

        $workingHour = $user->schedules()->where('status',1)->get()->groupBy('week_name');

        $jobSuccess = Booking::whereIn('service_id',$services->pluck('id')->toArray())->where('is_completed',1)->count();
        $datePeriod = CarbonPeriod::create(now(), now()->addDays(6));

        $appointments = [];

        foreach($datePeriod as $date){
            $appointments [] = (new AppointmentService)->generateTimeData($date);
        }

        return view('frontend.provider_details', compact('pageTitle','user','services','workingHour','jobSuccess','appointments'));
    }

    public function experts()
    {
        $pageTitle = 'Our Experts';
       
       
        $experts = User::where('status',1)->serviceProvider()->get();
        return view('frontend.experts',compact('pageTitle','experts'));
    }

    public function searchExperts(Request $request)
    {
        if(!$request->has('search')){
            $notify[] = ['error','Invalid Parameters'];
            return redirect()->route('home')->withNotify($notify);
        }

        $search = $request->search;

        $experts = User::where('status',1)->serviceProvider()->where(function($q)use($search){return $q->where('fname','LIKE','%'.$search.'%');})->get();

        $pageTitle = 'Your Searched Experts';
       
        return view('frontend.experts',compact('pageTitle','experts'));

    }




}
