<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests;
use Input;
use Auth;
use Response;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\PasswordBroker;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->helper = new \ApartHelper;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
             //'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        try
        {
            $user_type = 1;
            $active    = 0;
            $company   = $data['company'];
        }catch(\Exception $d)
        {
            $user_type = 0;
            $active    = 1;
            $company   = "Not Required";
        }

        $hash = rand(111111, 999999);
        $array = [
            'company'  => $company,
            'name'     => $data['name'],
            'surname'  => $data['surname'],
            'phone'    => $data['phone'],
            'email'    => $data['email'],
            'address'  => $data['address'],
            'password' => bcrypt($data['password']),
            'user_type'=> $user_type,
            'active'   => $active,
            'hash_key' => $hash,
        ];



       $user = User::create($array);
       if(count($user))
       {
            $mail_data = [
                'name'      => $user->name,
                'email'     => $data['email'],
                'view'      => 'emails.confirm-email',
                'hash'      => $hash,
                'subject'   => 'Please verify your email address',
            ];

            try 
                {
                    $mail_data['link' ] = url('/') . '/confirm/' . $hash;
                         
                         $this->helper->send_mail($mail_data);
                }
               catch (\Exception $e)
               {
                        //dd($e);
                        
               }

       }
        
       return $user; 
    }




    /**Register user method**/
    public Function postRegister() {
        $postData = Input::all();
        $company  = Input::get('company');
       if($company == "")
       {
        $user_type = 0;
        $active    = 1;
        $company   = "Not Required";
        $name_up   = Input::get('name');
       }else
       {
         $user_type = 1;
         $active    = 0;
         $name_up   = Input::get('company');
       }
        

        $rules = array(
            'email'     => 'required|email|unique:users,email',
            'city'      => 'required',
            'zipcode'   => 'required'            
        );

        $hash = rand(111111, 999999);
        $array = [
            'company'   => $company,
            'name'      => Input::get('name'),
            'surname'   => Input::get('surname'),
            'phone'     => substr(Input::get('phone'),3),
            'email'     => Input::get('email'),
            'address'   => Input::get('address'),
            'city'      => Input::get('city'),
            'zipcode'   => Input::get('zipcode'),
            'password'  => bcrypt(Input::get('password')),
            'user_type' => $user_type,
            'active'    => $active,
            'hash_key'  => $hash,
        ];


        $validator = Validator::make($array, $rules);

        if ($validator->fails()) {

            return Response::json(['status' => 0, 'message' => 'This email ID already registered!']);
            //return Redirect::back()->withInput()->withErrors($validator)->with('message', 'Opps! You made a mistake');
        }else
        {
            $user = User::create($array);
               if(count($user))
               {
                    if($company == "Not Required")
                    {
                        $mail_data = [
                            'company'   => $name_up,
                            'name'      => $name_up,
                            'user_type' => $user_type,
                            'email'     => Input::get('email'),
                            'city'      => Input::get('city'),
                            'zipcode'   => Input::get('zipcode'),
                            'view'      => 'emails.confirm-email',
                            'hash'      => $hash,
                            'subject'   => 'Please verify your email address',
                        ];
                    }else 
                    {
                        $mail_data = [
                            'company'   => $company,
                            'name'      => $name_up,
                            'user_type' => $user_type,
                            'email'     => Input::get('email'),
                            'city'      => Input::get('city'),
                            'zipcode'   => Input::get('zipcode'),
                            'view'      => 'emails.confirm-email',
                            'hash'      => $hash,
                            'subject'   => 'Please verify your email address',
                        ];
                    }

                    try 
                        {
                            $mail_data['link' ] = url('/') . '/confirm/' . $hash;
                                 
                                 $this->helper->send_mail($mail_data);
                        }
                       catch (\Exception $e)
                       {
                                //dd($e);
                                
                       }
                    return Response::json(['status' => 1, 'message' => 'Registration Successful. Please Verify Your Email.']);   

               }
        }
        
    }


    


    public function freshLogin()
    {
      if(\Request::isMethod('post') && \Request::ajax())
      {  
          $credentials['email'] = Input::get('email');
          $credentials['password'] = Input::get('password');
          $credentials['is_verified'] = 1;

          $credentials1['email'] = Input::get('email');
          $credentials1['password'] = Input::get('password');
          $credentials1['is_verified'] = 0;
          if (Auth::attempt($credentials)) {
             if(Auth::user()->active == 0)
             {
                Auth::logout();
                return Response::json(['status' => -1, 'id' => Auth::id(), 'message' => 'Please Contact or wait for admin approval!']);
             }else{
          
             return Response::json(['status' => 1, 'user_type' => Auth::user()->user_type, 'id' => Auth::id(), 'message' => 'Successfully Login!']);
            }
          } else if(Auth::attempt($credentials1)) {
            Auth::logout();
            return Response::json(['status' => 0, 'message' => 'You are not verified user! Please verify your Email']);

          }else
          {
             return Response::json(['status' => -1, 'message' => 'Email/password not match.']);
          }
      }
    }

    protected function getEmailSubject()
    {
        return isset($this->subject) ? $this->subject : 'Your Password Reset Link';
    }

    public function forgetPassword(Request $request, PasswordBroker $passwords)
    {
        if( $request->ajax() )
        {
            $this->validate($request, ['email' => 'required|email']);

            $response = $passwords->sendResetLink($request->only('email'), function($m)
            {
                $m->subject($this->getEmailSubject());
            });


            switch ($response)
            {
                case PasswordBroker::RESET_LINK_SENT:
                   return[
                       'error'=>'false',
                       'msg'=>'A password link has been sent to your email address'
                   ];

                case PasswordBroker::INVALID_USER:
                   return[
                       'error'=>'true',
                       'msg'=>"We can't find a user with that email address"
                   ];
            }
        }
        return false;
    }


}
