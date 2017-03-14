<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function home()
    {
       return back();
    }

    public function index()
    {
      
      if(Auth::user() && Auth::user()->is_admin && Auth::user()->user_type == 2)
      {
        return redirect()->action('AdminController@admin_dashboard');
      }else if(Auth::user() && Auth::user()->user_type == 1)
      {
        if(Auth::user()->is_verified==1 && Auth::user()->active==1)
        {
        return back()->with('message','');
        }else if(Auth::user()->is_verified==1 && Auth::user()->active==0)
        {
           \Session::flash('flash_message','Admin Has Not Verified Your Email.');
            Auth::logout();
            return back();
        }else if(Auth::user()->is_verified==0)
        {
            \Session::flash('flash_message','Please Verify Your Email.');
            Auth::logout();
            return back();
        }
      }else
      {
        \Session::flash('flash_message','Please Verify You Email.');
        Auth::logout();
        return back();
      }
    }


    public function afterLogin()
    {
      
      

      if(Auth::user() && Auth::user()->is_admin && Auth::user()->user_type == 2)
      {
        return redirect()->action('AdminController@admin_dashboard');
      }else if(Auth::user() && Auth::user()->user_type == 1)
      {
        if(Auth::user()->is_verified==1 && Auth::user()->active==1)
        {
        return back()->with('message','');
        }else if(Auth::user()->is_verified==1 && Auth::user()->active==0)
        {
           \Session::flash('flash_message','Admin Has Not Verified Your Email.');
            Auth::logout();
            return back();
        }else if(Auth::user()->is_verified==0)
        {
            \Session::flash('flash_message','Please Verify Your Email.');
            Auth::logout();
            return back();
        }
      }else
      {
        if(Auth::user()->is_verified==0)
        {
         \Session::flash('flash_message','Please Verify You Email.');
          Auth::logout();
          return back();
        }else
        {
          return back();
        }
      }
    }

    public function about()
    {
       return view('frontend.aboutus');
    }

    public function edit_Profile_host()
    {
      return view('frontend.profile.edit');
    }

    public function provider_dashboard() {
      if( Auth::user()->user_type == 1 ){
        $messages = DB::table('admin_messages')->orderBy('id','DESC')->limit(5)->get();
        
        return view('frontend.property.provider-dashboard',compact('messages'));
      }else{
        return back();
      }
    }
}
