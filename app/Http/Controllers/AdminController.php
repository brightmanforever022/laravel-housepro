<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;
use Validator;
use Mail;
use Auth;
use App\HomeMonatizeVideo;
use App\User as User;
use App\PropertyType as PropertyType;
use App\Property as Property;
use App\Payment as Payment;
use Image;
use Hash;



class AdminController extends Controller
{   
   
    //constructor
    public function __construct(User $user, PropertyType $property_type, Property $property,  Payment $payment) {
         $this->middleware('auth');
         $this->user = $user;
         $this->property_type = $property_type;
         $this->property = $property;
         $this->payment  = $payment;
    }
     
    public function propertyCreate()
    {
         $type_create_data['name'] = Input::get('name');
         $this->property_type->create($type_create_data);
         $properties = $this->property_type->get();
         return view('backend.property_type')->with('properties', $properties);
    }
     
    
    public function propertyUpdate()
    {
         $id = Input::get('id');
         $type_edit_data['name'] = Input::get('name');
         $this->property_type->where('id', $id)->update($type_edit_data);
        return back();
    }


    public function userProfileUpdate()
    {
        $id = Input::get('id');
        $user_edit_data['name'] = Input::get('name');
        $user_edit_data['surname'] = Input::get('surname');
        $user_edit_data['phone'] = Input::get('phone');
        $user_edit_data['email'] = Input::get('email');
        $user_edit_data['address'] = Input::get('address');
        $user_edit_data['additional_address'] = Input::get('additional_address');
        $user_edit_data['place'] = Input::get('place');
        $this->user->where('id', $id)->update($user_edit_data);
        return back();
       
    } 

    public function percentile($montly_providers, $montly_pre_providers)
    {
      $pre1        = 0;
      $current1    = 0;
      $percentage1 = 0;
      //echo "<pre>";
      //print_r($montly_providers);
      //print_r($montly_pre_providers);
      
      if(empty($montly_providers) && !empty($montly_pre_providers))
      {
          $pre1       = $montly_pre_providers[0]->total;
          $avgdiff1   = $current1  - $pre1;
          $avgsum1    = ($current1  + $pre1) / 2;
          $percentage1= ($avgdiff1 / $avgsum1) * 100;
          //echo "1:".$pre1.":".$current1.":".$avgdiff1.":".$avgsum1.":".$percentage1;

      }else if(!empty($montly_providers) && empty($montly_pre_providers))
      {
          $current1   = $montly_providers[0]->total;
          $avgdiff1   = $current1  - $pre1;
          $avgsum1    = ($current1  + $pre1) / 2;
          $percentage1= ($avgdiff1 / $avgsum1) * 100;
          //echo "2:".$pre1.":".$current1.":".$avgdiff1.":".$avgsum1.":".$percentage1;
      }else if(!empty($montly_providers) && !empty($montly_pre_providers))
      {
          $pre1       = $montly_pre_providers[0]->total;
          $current1   = $montly_providers[0]->total;
          $avgdiff1   = $current1  - $pre1;
          $avgsum1    = ($current1  + $pre1) / 2;
          $percentage1= ($avgdiff1 / $avgsum1) * 100;
          //echo "2:".$pre1.":".$current1.":".$avgdiff1.":".$avgsum1.":".$percentage1;
      }
      //die;
      return array($pre1, $current1, $percentage1);
      

    }
    public function admin_dashboard()
    {
     
      // $ga = new GoogleAnalyticsAPIController; 
      // $ga->auth->setClientId('1018568614469-9uo2ikddddgklpvn44mmmqmkvib363uv.apps.googleusercontent.com'); // From the APIs console
      // $ga->auth->setClientSecret('3BJ0oTG6JbIIc71GLL0R17qJ'); // From the APIs console
      // $ga->auth->setRedirectUri('http://development.hestawork.com/apartolino1/public/admin_dashboard'); // Url to your app, must match one in the APIs console
      // // Get the Auth-Url
      // $url = $ga->auth->buildAuthUrl();
      // header('Location: '.$url);
      // if(isset($_GET['code'])){
      // $code = $_GET['code'];
      // $auth = $ga->auth->getAccessToken($code);
      // print_r($auth);
      //   // Try to get the AccessToken
      //   if ($auth['http_code'] == 200) {
      //       $accessToken = $auth['access_token'];
      //       $refreshToken = $auth['refresh_token'];
      //       $tokenExpires = $auth['expires_in'];
      //       $tokenCreated = time();
      //   } else {
      //       // error...
      //   }
      // }
      // die;

      $return1[1] = '';
       $return1[2] = '';
       $return2[1] = '';
       $return2[2] = '';
       $return3[1] = '';
       $return3[2] = '';
       $return4[1] = '';
       $return4[2] = '';
       $return5[1] = '';
       $return5[2] = '';
       $return6[1] = '';
       $return6[2] = '';
       $return7[1] = '';
       $return7[2] = '';
       $return8[1] = '';
       $return8[2] = '';

      $providers = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, MONTH( created_at ) AS m, COUNT( DISTINCT id ) AS total FROM users where user_type = 1 AND YEAR( created_at ) = ".date('Y')." GROUP BY y, m") );

      $tenants = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, MONTH( created_at ) AS m, COUNT( DISTINCT id ) AS total FROM users where user_type = 0 AND YEAR( created_at ) = ".date('Y')." GROUP BY y, m") );

      $new_bookings = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, MONTH( created_at ) AS m, COUNT( DISTINCT id ) AS total FROM payments where YEAR( created_at ) = ".date('Y')." AND MONTH( created_at ) = ".date('m')." GROUP BY y, m") );

      $yearly_bookings = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, MONTH( created_at ) AS m, COUNT( DISTINCT id ) AS total FROM payments where YEAR( created_at ) = ".date('Y')."  GROUP BY y, m") );


      $properties = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, MONTH( created_at ) AS m, COUNT( DISTINCT id ) AS total FROM properties where  YEAR( created_at ) = ".date('Y')." GROUP BY y, m") );
       
      /*
       Provider Statistic Monthly
       */ 
      $montly_providers = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, MONTH( created_at ) AS m, COUNT( DISTINCT id ) AS total FROM users where user_type = 1 AND YEAR( created_at ) = ".date('Y')." AND MONTH( created_at ) = ".date('m')." GROUP BY y, m") );

      if(date('m') != 1)
      {
        $montly_pre_providers = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, MONTH( created_at ) AS m, COUNT( DISTINCT id ) AS total FROM users where user_type = 1 AND YEAR( created_at ) = ".date('Y')." AND MONTH( created_at ) = ".(date('m') - 1)." GROUP BY y, m") );
      }

      if ($montly_providers) {
        $return1 = $this->percentile($montly_providers, $montly_pre_providers);
      }
      /*
       Provider Statistic Yearly
       */ 
      $yearly_providers = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, COUNT( DISTINCT id ) AS total FROM users where user_type = 1 AND YEAR( created_at ) = ".date('Y')."  GROUP BY y") );

      if(date('m') != 1)
      {
        $yearly_pre_providers = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, COUNT( DISTINCT id ) AS total FROM users where user_type = 1 AND YEAR( created_at ) = ".(date('Y') - 1)." GROUP BY y") );
      }
      if ($yearly_providers) {
        $return2 = $this->percentile($yearly_providers, $yearly_pre_providers);
      }
      /*
       Tenant Statistic Monthly
       */ 
      $montly_tenants = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, MONTH( created_at ) AS m, COUNT( DISTINCT id ) AS total FROM users where user_type = 0 AND YEAR( created_at ) = ".date('Y')." AND MONTH( created_at ) = ".date('m')." GROUP BY y, m") );

      if(date('m') != 1)
      {
        $montly_pre_tenants = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, MONTH( created_at ) AS m, COUNT( DISTINCT id ) AS total FROM users where user_type = 0 AND YEAR( created_at ) = ".date('Y')." AND MONTH( created_at ) = ".(date('m') - 1)." GROUP BY y, m") );
      }
      if ($montly_tenants) {
        $return3 = $this->percentile($montly_tenants, $montly_pre_tenants);
      }

      /*
       Tenant Statistic Yearly
       */ 
      $yearly_tenants = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, COUNT( DISTINCT id ) AS total FROM users where user_type = 0 AND YEAR( created_at ) = ".date('Y')."  GROUP BY y") );

      if(date('m') != 1)
      {
        $yearly_pre_tenants = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, COUNT( DISTINCT id ) AS total FROM users where user_type = 0 AND YEAR( created_at ) = ".(date('Y') - 1)." GROUP BY y") );
      }
      if ($yearly_tenants) {
        $return4 = $this->percentile($yearly_tenants, $yearly_pre_tenants);
      }


      /*
       New Booking Montly
       */
      
      $new_bookings = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, MONTH( created_at ) AS m, COUNT( DISTINCT id ) AS total FROM payments where YEAR( created_at ) = ".date('Y')." AND MONTH( created_at ) = ".date('m')." GROUP BY y, m") );
      $prev_new_bookings = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, MONTH( created_at ) AS m, COUNT( DISTINCT id ) AS total FROM payments where YEAR( created_at ) = ".date('Y')." AND MONTH( created_at ) = ".(date('m')-1)." GROUP BY y, m") );
      $return5 = $this->percentile($new_bookings, $prev_new_bookings);

      
      /*
       New Booking Yearly
       */
      
      $yearly_bookings = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, COUNT( DISTINCT id ) AS total FROM payments where YEAR( created_at ) = ".date('Y')."  GROUP BY y") );
      $prev_yearly_bookings = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, COUNT( DISTINCT id ) AS total FROM payments where YEAR( created_at ) = ".(date('Y')-1)."  GROUP BY y") );
      $return6 = $this->percentile($yearly_bookings, $prev_yearly_bookings);


      /*
       New Listing Of Property Montly
       */
      
      $montly_properties = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, MONTH( created_at ) AS m, COUNT( DISTINCT id ) AS total FROM properties where  YEAR( created_at ) = ".date('Y')." AND MONTH( created_at ) = ".date('m')." GROUP BY y, m") );

      $prev_montly_properties = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, MONTH( created_at ) AS m, COUNT( DISTINCT id ) AS total FROM properties where  YEAR( created_at ) = ".date('Y')." AND MONTH( created_at ) = ".(date('m')-1)." GROUP BY y, m") );
      $return7 = $this->percentile($montly_properties, $prev_montly_properties);


      /*
       New Listing Of Property Yearly
       */
      
      $yearly_properties = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, COUNT( DISTINCT id ) AS total FROM properties where  YEAR( created_at ) = ".date('Y')."  GROUP BY y") );

      $prev_yearly_properties = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, COUNT( DISTINCT id ) AS total FROM properties where  YEAR( created_at ) = ".(date('Y')-1)." GROUP BY y") );
      $return8 = $this->percentile($yearly_properties, $prev_yearly_properties);

      //*************Monthly Stats Income******************
      $host_id = DB::select( DB::raw("SELECT host_id,COUNT( host_id ) AS total FROM payments where  YEAR( created_at ) = ".date('Y')." GROUP BY YEAR( created_at ),host_id") );

      foreach ($host_id as $value) {
        # code...
          if($value->total < 50)
           {
              $total_interest[$value->host_id]['interest'] = 3.5;
              $total_interest[$value->host_id]['total'] = $value->total;

           }else if($value->total > 50 && $value->total < 100)
           {
              $total_interest[$value->host_id]['interest'] = 3;
              $total_interest[$value->host_id]['total'] = $value->total;

           }else if($value->total > 100 && $value->total < 200)
           {
              $total_interest[$value->host_id]['interest'] = 2.5;
              $total_interest[$value->host_id]['total'] = $value->total;

           }else if( $value->total >= 200)
           {
              $total_interest[$value->host_id]['interest'] = 2;
              $total_interest[$value->host_id]['total'] = $value->total;
           }
        
      }

      //***************fetch event dates for month****************
      $income_date = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, MONTH( created_at ) AS m, DAY( created_at ) AS d FROM payments where  YEAR( created_at ) = ".date('Y')." AND MONTH( created_at ) = ".date('m')." GROUP BY y, m, d") );

      if(isset($income_date[0]))
      {
   
        //*****************calculating number of days in month************
        $numDays = cal_days_in_month (CAL_GREGORIAN, $income_date[0]->m,$income_date[0]->y);
        for ($i=1; $i <= $numDays; $i++) { 
            $monthly_income[$i] = 0; 
        }
        
       
        //***************per day event record for month****************
        
        foreach ($income_date as $value) {
          # code...
          $per_date_record[$value->d] = DB::select( DB::raw("SELECT * FROM payments where  YEAR( created_at ) = ".$value->y." AND MONTH( created_at ) = ".$value->m." AND DAY( created_at ) = ".$value->d) );
        }
        //****************calculating amount for current month**************
       
        $i = 1;
        foreach ($monthly_income as $key => $value) {
          # code...
            foreach ($income_date as $key1 => $value1) {
              # code...
              if ($value1->d == $i) {
                # code...
                $amount = 0;
                foreach ($per_date_record[$i] as $key2 => $value2) {
                  # code...
                  $amount = $amount + (($total_interest[$value2->host_id]['interest'] * $value2->amount)/100);
                  
                }
                $monthly_income[$i] = $amount;
              }
            }
          $i++;
        }
        ////////////////////////////CALCULATING YEAR RECORD////////////////////////

        //***************fetch event dates for year****************
        $income_date_year = DB::select( DB::raw("SELECT YEAR( created_at ) AS y, MONTHNAME( created_at ) AS month,MONTH( created_at ) AS m, DAY( created_at ) AS d FROM payments where  YEAR( created_at ) = ".date('Y')." GROUP BY y, m, d") );

        //***************per day event record for month****************     
        foreach ($income_date_year as $value) {
          # code...
          $per_date_record_year[$value->month][$value->d] = DB::select( DB::raw("SELECT * FROM payments where  YEAR( created_at ) = ".$value->y." AND MONTH( created_at ) = ".$value->m." AND DAY( created_at ) = ".$value->d) );
        }
        $yearly_income = array( 'January'=>0,
                                'February'=>0,
                                'March'=>0,
                                'April'=>0,
                                'May'=>0,
                                'June'=>0,
                                'July'=>0,
                                'August'=>0,
                                'September'=>0,
                                'October'=>0,
                                'November'=>0,
                                'December'=>0);
        //****************calculating amount for current year**************
       
        $i = 1;
        foreach ($yearly_income as $key => $value) {
          # code...
          if (isset($per_date_record_year[$key])) {
            $amount = 0;
            foreach ($per_date_record_year[$key] as $key1 => $value1) {
              
              foreach ($value1 as $key2 => $value2) {
                $amount = $amount + (($total_interest[$value2->host_id]['interest'] * $value2->amount)/100);
                /*$amount = $amount + $value2->amount;*/
              }
              $yearly_income[$key] = $amount;
            }
          }
         
          $i++;
        }
       

        $users = $this->user->where('is_admin','!=',1)->get();
        $transactions_new = $this->property->where('booking_id','!=',0)->get();  
        $bookings_new = $this->property->where('booking_id','!=',0)->orderBy('updated_at', 'desc')->get();

       

        return view('backend.home')->with('users', $users)->with('providers', $providers)->with('tenants', $tenants)->with('new_bookings', $new_bookings)->with('yearly_bookings', $yearly_bookings)->with('properties', $properties)->with('users', $users)->with('transactions_new', $transactions_new)->with('bookings_new', $bookings_new)->with('percentage1',  $return1[2])->with('current1', $return1[1])->with('percentage2',  $return2[2])->with('current2', $return2[1])->with('percentage3',  $return3[2])->with('current3', $return3[1])->with('percentage4',  $return4[2])->with('current4', $return4[1])->with('percentage5',  $return5[2])->with('current5', $return5[1])->with('percentage6',  $return6[2])->with('current6', $return6[1])->with('percentage7',  $return7[2])->with('current7', $return7[1])->with('percentage8',  $return8[2])->with('current8', $return8[1])->with('monthly_income',$monthly_income)->with('yearly_income',$yearly_income);
      }else{
        $users = $this->user->where('is_admin','!=',1)->get();
        $transactions_new = $this->property->where('booking_id','!=',0)->get();  
        $bookings_new = $this->property->where('booking_id','!=',0)->orderBy('updated_at', 'desc')->get();

       

        return view('backend.home')->with('users', $users)->with('providers', $providers)->with('tenants', $tenants)->with('new_bookings', $new_bookings)->with('yearly_bookings', $yearly_bookings)->with('properties', $properties)->with('users', $users)->with('transactions_new', $transactions_new)->with('bookings_new', $bookings_new)->with('percentage1',  $return1[2])->with('current1', $return1[1])->with('percentage2',  $return2[2])->with('current2', $return2[1])->with('percentage3',  $return3[2])->with('current3', $return3[1])->with('percentage4',  $return4[2])->with('current4', $return4[1])->with('percentage5',  $return5[2])->with('current5', $return5[1])->with('percentage6',  $return6[2])->with('current6', $return6[1])->with('percentage7',  $return7[2])->with('current7', $return7[1])->with('percentage8',  $return8[2])->with('current8', $return8[1])->with('monthly_income',[])->with('yearly_income',[]);

      }  
    }

    public function admin_home()
    {
        $users = $this->user->where('is_admin','!=',1)->get();
        
        return view('backend.users')->with('users', $users); 
    }

    public function property_types()
    {
        $properties = $this->property_type->get();
        return view('backend.property_type')->with('properties', $properties); 
    }

    public function change_status($id, $active)
    {
        $update_field =[   
                'active'=>intVal($active),            
                'updated_at'=> date('Y-m-d H:i:s'),
                ];
        $this->user->where('id', intVal($id))->update($update_field);

        $users = $this->user->where('is_admin','!=',1)->get();    
       
        return view('backend.home')->with('users', $users); 
       
    }

    public function logout()
    {
         Auth::logout();
         return Redirect::route('login_page');

    }


    public function admin_booking()
    {
       $properties = $this->property->where('booking_id','!=',0)->orderBy('updated_at', 'desc')->get();
       return view('backend.booking.booking')->with('properties', $properties); 
    }

    public function admin_payment()
    {
       $properties = $this->property->where('booking_id','!=',0)->orderBy('updated_at', 'desc')->get();
       return view('backend.payment.payment')->with('properties', $properties); 
    }


    public function admin_refunded()
    {
       $bookings = $this->payment->where('refund_status','=',1)->get();
       return view('backend.payment.refund')->with('bookings', $bookings); 
    }


    public function admin_transferd()
    {
       $bookings = $this->payment->where('refund_status','=',2)->get();
       return view('backend.payment.transfer')->with('bookings', $bookings); 
    }


    public function intitial_payments()
    {
        $initials = DB::table('admin_initials')->get();
        return view('backend.intitial_payments')->with('initials', $initials); 
    }

    public function update_initials()
    {
        $id = Auth::user()->id;
        $initials_num = Input::get('initials');
        DB::table('admin_initials')->update(array('percentage' => $initials_num));
        $initials =  DB::table('admin_initials')->get();
        \Session::flash('message','Initials value changed successfully.');
        return view('backend.intitial_payments')->with('initials', $initials); 
    }

    public function upload_video()
    {
       return view('backend.propertytype.upload_video'); 
    }

    public function uploadVideo(Request $request)
    {
        
      try { 
            $destinationPath = public_path('video'); // upload path
            $tempPath = public_path('video/temp');
                            //dd($request->all());                     
            if (isset($request->video_file)) {
                $extension_video_file = $request->video_file->getClientOriginalExtension();
                $fileName_video_file = $request->video_file->getClientOriginalName();
                $request->video_file->move($tempPath,$fileName_video_file);
                $old_file = public_path('video') . '/ocean_123.mp4';
                if (unlink($old_file)) {
                    rename($tempPath . '/' . $fileName_video_file, $old_file);
                }
            }

            if (isset($request->video_mov_file)) {
                $extension_video_mov_file = $request->video_mov_file->getClientOriginalExtension();
                $fileName_video_mov_file = $request->video_mov_file->getClientOriginalName();
                $request->video_mov_file->move($tempPath,$fileName_video_mov_file);
                $old_file = public_path('video') . '/ocean_123.mov';
                if (unlink($old_file)) {
                    rename($tempPath . '/' . $fileName_video_mov_file, $old_file);
                }
            }

            if (isset($request->video_ogv_file)) {
                $extension_video_ogv_file = $request->video_ogv_file->getClientOriginalExtension();
                $fileName_video_ogv_file = $request->video_ogv_file->getClientOriginalName();
                $request->video_ogv_file->move($tempPath,$fileName_video_ogv_file);
                $old_file = public_path('video') . '/ocean_123.ogv';
                if (unlink($old_file)) {
                    rename($tempPath . '/' . $fileName_video_ogv_file, $old_file);
                }
            }

            if (isset($request->video_webm_file)) {
                $extension_video_webm_file = $request->video_webm_file->getClientOriginalExtension();
                $fileName_video_webm_file = $request->video_webm_file->getClientOriginalName();
                $request->video_webm_file->move($tempPath,$fileName_video_webm_file);
                $old_file = public_path('video') . '/ocean_123.webm';
                if (unlink($old_file)) {
                    rename($tempPath . '/' . $fileName_video_webm_file, $old_file);
                }
            }

            if (isset($request->video_jpg_file)) {
                $destinationPath = $destinationPath . '/video';
                $extension_video_jpg_file = $request->video_jpg_file->getClientOriginalExtension();
                $fileName_video_jpg_file = $request->video_jpg_file->getClientOriginalName();
                $request->video_jpg_file->move($tempPath,$fileName_video_jpg_file);
                $old_file = public_path('video') . '/ocean_123.jpg';
                if (unlink($old_file)) {
                    rename($tempPath . '/' . $fileName_video_jpg_file, $old_file);
                }
            }
            Session::flash('message', 'Upload successfully'); 
            return redirect('/admin_dashboard');
        } catch (\Exception $e) {
            dd($e);
        }


    }

    public function global_messages( ) {
      $messages = DB::table('admin_messages')->orderBy('id','DESC')->get();
      return view('backend.messages.messages',compact('messages'));
    }

    public function post_global_messages( Request $request ) {
      DB::table('admin_messages')->insert(array('message' => Input::get('message')));
      Session::flash('message', 'Message sent successfully'); 
      return back();
    }
 
    public function delete_global_message( $id ) {
      $messages = DB::table('admin_messages')->where('id', '=', $id )->delete();
      Session::flash('message', 'Message deleted successfully'); 
      return back();
    }

    public function passwordSetting ()
    {
        try {
            return view('backend.passwordSetting');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function savePasswordSetting (Request $request)
    {
        try {

            if ((!isset(Auth::user()->is_admin))&&(Auth::user()->is_admin != 1)) {
                //flash()->error('Error', 'Unauthorised Access');
                return redirect('/');
                dd();
            }

            $new_pass = $request->new_pass; 
            $confirm_pass = $request->confirm_pass; 

            if (Hash::check($request->old_pass, Auth::user()->password)) {

                if (trim($new_pass) != '' && trim($confirm_pass) != '') {

                    if ($new_pass == $confirm_pass) {

                        $this->user->where('id',Auth::user()->id)->update(['password'=>bcrypt($new_pass)]);
                        Session::flash('message', 'Password has been Updated successfully');

                    }else{
                        Session::flash('message', 'Confirm Password Not Matched');
                    }
                } else{
                    Session::flash('message', 'Please fill new password');
                }
                    
            }else{
                Session::flash('message', 'Incorrect Current Password');
            }

            return redirect()->route('admin.password.setting');

        } catch (\Exception $e) {
            dd($e);
        }
    }

}