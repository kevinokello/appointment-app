<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ManageProviderController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = 'All Doctors';

        $search = $request->search;

        $providers = User::when($search, function($q) use($search){
            $q->where('fname','LIKE','%'.$search.'%')
              ->orWhere('lname','LIKE','%'.$search.'%')
              ->orWhere('username','LIKE','%'.$search.'%')
              ->orWhere('email','LIKE','%'.$search.'%')
              ->orWhere('mobile','LIKE','%'.$search.'%');
        })->latest()->serviceProvider()->paginate();
      
        

        return view('admin.providers.index', compact('pageTitle', 'providers'));
    }
    public function providerDetails(Request $request)
    {
        $provider = User::where('id', $request->provider)->with('services')->withCount('services')->serviceProvider()->firstOrFail();


        $pageTitle = "Service Provider Details";

        return view('admin.providers.details', compact('pageTitle', 'provider'));
    }

   

    public function providerUpdate(Request $request, User $provider)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'country' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'state' => 'required',
            'status' => 'required|in:0,1'
            ,'featured' => 'required|in:0,1'
        ]);

        $data = [
            'country' => $request->country,
            'city' => $request->city,
            'zip' => $request->zip,
            'state' => $request->state,
        ];


        $provider->fname = $request->fname;
        $provider->lname = $request->lname;
        $provider->address = $data;
        $provider->featured = $request->featured;
        $provider->status = $request->status;

        $provider->save();



        $notify[] = ['success', 'Provider Updated Successfully'];

        return back()->withNotify($notify);
    }

 
}
