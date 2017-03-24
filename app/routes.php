<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




Route::get('/original-route', function () {
  return redirect('/');
});

Route::get('/confirm/{hash_key}', 'SearchController@confirm');
Route::get('/', 'SearchController@index');
Route::get('/jobs', function () {
    return view('frontend.links.jobs');
});
Route::get('/terms-of-services', function () {
    return view('frontend.links.terms');
});
Route::get('/privacy-policy', function () {
    return view('frontend.links.privacy_policy');
});
Route::get('/about', function () {
    return view('frontend.links.aboutus');
});
Route::get('/contactus', function () {
    return view('frontend.links.contactus');
});
Route::get('/advertising', function () {
    return view('frontend.links.advertising');
});
Route::get('/disclaimer', function () {
    return view('frontend.links.disclaimer');
});
Route::get('/imprint', function () {
    return view('frontend.links.imprint');
});
Route::get('/adevertise', function () {
    return view('frontend.links.adevertise');
});
Route::get('/price-plan', function () {
    return view('frontend.links.price-plan');
});
Route::get('/customer-service', function () {
    return view('frontend.links.customer-service');
});
Route::get('/site-map', function () {
    return view('frontend.links.site-map');
});
Route::get('/how-it-work', function () {
    return view('frontend.links.help');
});
Route::get('/help1', function () {
    return view('frontend.links.help1');
});
Route::get('/how-to-book', 'GetController@how_to_book');
Route::get('/help-footer', 'GetController@help_footer');
Route::get('/press', 'GetController@press');
Route::get('/getLoadBlog', 'GetController@getLoadBlog');
Route::get('/getCityLoad', 'GetController@getCityLoad');

Route::get('/provider-dashboard', 'HomeController@provider_dashboard' );


Route::get('/helloWorld', 'SearchController@helloWorld');

Route::get('/refundSale/{id}', 'PaypalController@refundSale');

Route::get('/payToHost/{paypal_email}/{amount}/{booking_id}/{user_id}', 'PaypalController@payToHost');


Route::post('postPayment', ['as' => 'postPayment', 'uses' => 'PaypalController@postPayment']);

Route::post('postRegister', ['as' => 'postRegister', 'uses' => 'Auth\AuthController@postRegister']);

Route::post('freshUserLogin', ['as' => 'freshLogin', 'uses' => 'Auth\AuthController@freshLogin']);
Route::post('forgetUserPassword', ['as' => 'forgetPassword', 'uses' => 'Auth\AuthController@forgetPassword']);

// Route::post('/search', 'SearchController@search');

Route::post('/search', array('as' => 'search', 'uses' => 'SearchController@search'));


Route::get('/search_home_link', array('as' => 'search_home_link', 'uses' => 'SearchController@search_home_link'));


Route::get('/search', function () {
  return redirect('/');
});

Route::get('/search_search', function () {
  return redirect('/');
});

// Route::post('/search_search', 'SearchController@search_search');

Route::post('/search_search', array('as' => 'search_search', 'uses' => 'SearchController@search_search'));

Route::post('/searchMap', array('as' => 'searchMap', 'uses' => 'SearchController@searchMap'));

Route::get('/searchMap',function()
{
  return redirect('/');

});

Route::get('/searchLocation', array('as' => 'searchLocation', 'uses' => 'SearchController@google_api'));

Route::auth();

/*
  Route Group Start For Host And User
*/
Route::group(['middleware' => ['auth']], function () {


Route::post('sendMessage', ['as' => 'sendMessage', 'uses' => 'UserController@sendMessage']);
Route::post('getMessage', ['as' => 'getMessage', 'uses' => 'UserController@getMessage']);

Route::get('/home', 'HomeController@index');

Route::get('/afterLogin', 'HomeController@afterLogin');

Route::get('/edit-profile-host', 'UserController@edit_Profile_host');

Route::get('/edit-profile-tenant', 'UserController@edit_Profile_tenant');

Route::post('editHostForm', ['as' => 'editHost', 'uses' => 'UserController@editHost']);

Route::post('editUserForm', ['as' => 'editHost', 'uses' => 'UserController@editHost']);


Route::get('deleteImage', ['as' => 'deleteUserImage', 'uses' => 'UserController@deleteUserImage']);
Route::post('editHostAccount', ['as' => 'editHostBankAccount', 'uses' => 'UserController@editHostBankAccount']);
Route::get('/create_new_add', function () {
    $countries = App\Country::get();
    $property_types = App\PropertyType::get();
    $features       = App\Feature::get();
    \Session::regenerateToken();
    return view('frontend.profile.new_add')->with('countries', $countries)->with('property_types', $property_types)->with('features', $features);
});


Route::get('uniqueReference', ['as' => 'uniqueReference', 'uses' => 'UserController@uniqueReference']);


Route::get('uniqueEditReference', ['as' => 'uniqueEditReference', 'uses' => 'UserController@uniqueEditReference']);


Route::post('saveProperty', ['as' => 'saveHostProperty', 'uses' => 'UserController@saveHostProperty']);

Route::post('saveEditProperty', ['as' => 'saveEditHostProperty', 'uses' => 'UserController@saveEditHostProperty']);

Route::get('/deleteProperty/{id}', function ($id) {
  $properties = App\Property::where('id',$id)->delete();
  $properties = App\Property::where('user_id', Auth::user()->id)->get();
  return redirect('/listing')->with('message','One Ads Deleted Successfully')->with('color','green');
});

Route::get('/editProperty/{id}', function ($id) {
  $properties = App\Property::where('id', $id)->get();
  $countries = App\Country::get();
  $property_types = App\PropertyType::get();
  $features       = App\Feature::get();
    \Session::regenerateToken();
  $guests = array(1,2,3,4,5,6,7);
  return view('frontend.profile.property_edit')->with('properties', $properties)->with('countries', $countries)->with('property_types', $property_types)->with('features', $features)->with('guests', $guests);
});

// Favorite
Route::get('/favorites', function () {  
    if(Auth::check())
    $user_id = Auth::user()->id;  
    $favorites = App\Favorite::where('user_id', $user_id)->orderBy('property_id', 'ASC')->get();
    return view('frontend.property.favorites')->with('favorites', $favorites);
});
Route::get('/removeFavorite/{id}', function ($id) {
  $favorites = App\Favorite::where('id',$id)->delete();
  $favorites = App\Favorite::where('user_id', Auth::user()->id)->get();
  return redirect('/favorites')->with('message','One Favorite Deleted Successfully')->with('color','green');
});
Route::get('/add_favorite/{id}', function($id){
  if(Auth::check())
    $user_id = Auth::user()->id;
    $favorite = App\Favorite::where('user_id', $user_id)->where('property_id', $id)->get();
    if(count($favorite) == 0){
      \App\Favorite::insert(['user_id'=>$user_id, 'property_id'=>$id]);
    }else{
      \App\Favorite::where('user_id', $user_id)->where('property_id', $id)->delete();
    }
    echo 'ok';
});

/*Host Booking Code Start*/

Route::get('/booking', function () {
    if(Auth::check())
    $user_id = Auth::user()->id;  
    $properties = App\Property::where('user_id', $user_id)->where('booking_id', '!=', 0)->where('property_booking_status', 0)->orderBy('created_at', 'DESC')->get();
    return view('frontend.property.booking')->with('properties', $properties);;
});


Route::get('/booking-reject', function () {
    if(Auth::check())
    $user_id = Auth::user()->id; 
    if(Auth::check() && Auth::user()->user_type == 1)
    { 
    $bookings = App\Payment::where('host_id', $user_id)->orderBy('created_at', 'DESC')->get();

        
    return view('frontend.property.booking-reject')->with('bookings', $bookings);
    }else
    {
     //$bookings = App\Payment::where('user_id', $user_id)->get();
     return view('frontend.property.booking-reject')->with('bookings', $bookings);
    }
    
});


Route::get('/booking-adopt', function () {
    if(Auth::check())
    $user_id = Auth::user()->id; 
    if(Auth::check() && Auth::user()->user_type == 1)
    { 
    $bookings = App\Payment::where('host_id', $user_id)->orderBy('created_at', 'DESC')->get();
    return view('frontend.property.booking-adopt')->with('bookings', $bookings);;
    }else
    {
    $bookings = App\Payment::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
    return view('frontend.property.booking-adopt')->with('bookings', $bookings);;
    }
});

/*Host Booking Code Start*/

Route::get('/booking-tenant', function () {
    if(Auth::check())
    $user_id = Auth::user()->id;  
    $bookings = App\Payment::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
    return view('frontend.property.booking-tenant')->with('bookings', $bookings);;
});

//Booking Functionality
Route::get('/accept/{id}', 'UserController@accept');

Route::get('/isPaypalEmail', function () {
  $user_id = Auth::user()->id;  

});

Route::post('/editPaypalAccount', function () {
  $paypal_email = $_REQUEST['paypal_email'];  
  App\User::where('id', Auth::user()->id)->update(['paypal_email'=>$paypal_email]);
  return redirect('/edit-profile-host')->with('message','Paypal Account Added Successfully')->with('color','green');;
});

Route::get('/reject/{id}', 'UserController@reject');

Route::get('/listing', function () {  
    if(Auth::check())
    $user_id = Auth::user()->id;  
    $properties = App\Property::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
    return view('frontend.property.listing')->with('properties', $properties);
});




Route::post('saveTemporary', ['as' => 'saveImagesTemporary', 'uses' => 'UserController@saveImagesTemporary']);


Route::post('saveIcalTemporary', ['as' => 'saveIcalTemporary', 'uses' => 'UserController@saveIcalTemporary']);

Route::post('saveEidtTemporary', ['as' => 'saveImagesTemporary', 'uses' => 'UserController@saveEditImagesTemporary']);

Route::post('deleteSingleImage', ['as' => 'deleteSingleImageTest', 'uses' => 'UserController@deleteSingleImageTest']);

Route::get('payStatus', ['as' => 'payment.status', 'uses' => 'PaypalController@getPaymentStatus']);

});



Route::get('/single/{id}/{statrt_date}/{end_date}/{guests}/{address}/{price}', function ($id, $start_date, $end_date, $guests,$address,$price) {  
    $properties = App\Property::where('id', $id)->get();
       

       $city_where_met = explode(',', $address)[0];
       $price = $price; 
       $bedroom = $guests; 
       $datepicker = $start_date;

       $enddate = $end_date;  
       $end_date_query = $end_date;
            

       if($price == "")
        {
          $array[0] = 0;
          $array[1] = 10000;
        }else
        {
        $array = explode("-",$price);
        }
        
        if($bedroom == 0)
        $bedroom = 8;
        
        if($datepicker == 0)
        {
           $start_date_query = date('Y-m-d');
           $pass = '';
        }else
        {
            $start_date_query = date('Y-m-d',$datepicker);
            $pass = $start_date_query;
        }


        if($enddate == 0)
        {
           $date = strtotime("+1 day");
           $end_date_query = date('Y-m-d', $date);
           $pass_end = '';
        }else
        {
            $end_date = date('Y-m-d', $end_date_query);
            $pass_end = $end_date;
        }    
        
        $prevUser = App\Property::where('start_date','<=', $start_date_query)->where('apartment_for','<=' ,$bedroom)->where(DB::raw('CONCAT_WS(" ", plz_place, street)'), 'like', "%{$city_where_met}%")->where('booking_id', 0)->whereBetween('price_per_night', [$array[0], $array[1]])->where('id', '<', $properties[0]->id)->max('id');
        
        $nextUser = App\Property::where('start_date','<=', $start_date_query)->where('apartment_for','<=' ,$bedroom)->where(DB::raw('CONCAT_WS(" ", plz_place, street)'), 'like', "%{$city_where_met}%")->where('booking_id', 0)->whereBetween('price_per_night', [$array[0], $array[1]])->where('id', '>', $properties[0]->id)->min('id');

        
    return view('frontend.search.single', compact('prevUser', 'nextUser'))->with('properties', $properties)->with('start_date', $start_date)->with('end_date', $end_date)->with('bedroom', $guests);
});

Route::get('/single/{id}', function ($id) {  
    $properties = App\Property::where('id', $id)->get();

    $prevUser = App\Property::where('booking_id', 0)->where('id', '<', $properties[0]->id)->max('id');
        
    $nextUser = App\Property::where('booking_id', 0)->where('id', '>', $properties[0]->id)->min('id');

    return view('frontend.search.single', compact('prevUser', 'nextUser'))->with('properties', $properties)->with('start_date', "")->with('end_date', "")->with('bedroom', '');
});

Route::get('/cancel/{id}', 'UserController@cancel');

//admin alogin form view
Route::get('admin/login',function (){
    Auth::logout();
    return view('backend.auth.login');
});

Route::group(['middleware' => ['auth']], function () { 

Route::get('/admin_dashboard', 'AdminController@admin_dashboard');
Route::get('/admin_home', 'AdminController@admin_home');
Route::get('/property_types', 'AdminController@property_types');
Route::get('/intitial_payments', 'AdminController@intitial_payments');
Route::get('/upload_video', 'AdminController@upload_video');

Route::post('/update_initials', 'AdminController@update_initials');

Route::get('/change_status/{id}/{active}', 'AdminController@change_status');

Route::get('/global-messages', 'AdminController@global_messages');
Route::post('/global-messages', 'AdminController@post_global_messages');
Route::get('/delete-global-message/{id}', ['as' => 'global-message.delete', 'uses' => 'AdminController@delete_global_message']);

Route::get('admin/dashboard',function (){
    
    $first_day_of_month = strtotime(date('Y-m-01'));
    $last_day_of_month = strtotime(date('Y-m-t'));
    });
});

Route::get('/admin_profile_view/{id}', function ($id) {
   $user = App\User::where('id', $id)->get();
    return view('backend.profile.profile')->with('user', $user);
});

Route::get('/admin_profile_edit/{id}', function ($id) {
    $user = App\User::where('id', $id)->get();
    return view('backend.profile.edit')->with('user', $user);
});

Route::post('userUpdate', ['as' => 'userProfileUpdate', 'uses' => 'AdminController@userProfileUpdate']);


Route::get('/admin_profile_delete/{id}', function ($id) {
   $user = App\User::where('id', $id)->delete();
   $user = App\User::get();
   return redirect('/admin_dashboard');
});


Route::get('/property_type_delete/{id}', function ($id) {
   $user = App\PropertyType::where('id', $id)->delete();
   return redirect('/property_types');
});

Route::get('/property_type_edit/{id}', function ($id) {
    $propertytype = App\PropertyType::where('id', $id)->get();
    return view('backend.propertytype.edit')->with('propertytype', $propertytype);
});

Route::get('/property_type_view/{id}', function ($id) {
   $propertytype = App\PropertyType::where('id', $id)->get();
    return view('backend.propertytype.profile')->with('propertytype', $propertytype);
});


Route::post('typeUpdate', ['as' => 'propertyUpdate', 'uses' => 'AdminController@propertyUpdate']);


Route::get('/add-property-type', function () {
    return view('backend.propertytype.add');
});


Route::post('typeCreate', ['as' => 'propertyCreate', 'uses' => 'AdminController@propertyCreate']);
Route::post('uploadVideo', ['as' => 'uploadVideo', 'uses' => 'AdminController@uploadVideo']);

Route::get('/admin_booking', ['as' => 'admin_booking', 'uses' => 'AdminController@admin_booking']);

Route::get('/admin_payment', ['as' => 'admin_payment', 'uses' => 'AdminController@admin_payment']);

Route::get('/admin_refunded', ['as' => 'admin_refunded', 'uses' => 'AdminController@admin_refunded']);

Route::get('/admin_transferd', ['as' => 'admin_transferd', 'uses' => 'AdminController@admin_transferd']);

/*
Route for Make frontend footer text dynamic via Admin
 */

//Book Functionality
Route::get('/how_to_book', ['as' => 'how_to_book', 'uses' => 'FooterDynamicController@how_to_book']);
Route::post('bookRow1Update', ['as' => 'row1Update', 'uses' => 'FooterDynamicController@row1Update']);
Route::post('bookRow2Update', ['as' => 'row2Update', 'uses' => 'FooterDynamicController@row2Update']);
Route::post('bookRow3Update', ['as' => 'row3Update', 'uses' => 'FooterDynamicController@row3Update']);

//Help Functionality
Route::get('/need_our_help', ['as' => 'need_our_help', 'uses' => 'FooterDynamicController@need_our_help']);
Route::get('/add_more_help', ['as' => 'add_more_help', 'uses' => 'FooterDynamicController@add_more_help']);
Route::post('saveHelpMenu', ['as' => 'saveHelpNewMenu', 'uses' => 'FooterDynamicController@saveHelpNewMenu']);
Route::post('helpRow1Update', ['as' => 'rowh1Update', 'uses' => 'FooterDynamicController@rowh1Update']);
Route::post('helpRow2Update', ['as' => 'rowh2Update', 'uses' => 'FooterDynamicController@rowh2Update']);

//Press Functionality
Route::get('/edit_press', ['as' => 'edit_press', 'uses' => 'FooterDynamicController@edit_press']);
Route::post('pressRow1Update', ['as' => 'rowp1Update', 'uses' => 'FooterDynamicController@rowp1Update']);
Route::post('pressRow2Update', ['as' => 'rowp2Update', 'uses' => 'FooterDynamicController@rowp2Update']);
Route::post('pressRow3Update', ['as' => 'rowp3Update', 'uses' => 'FooterDynamicController@rowp3Update']);
Route::post('pressRow4Update', ['as' => 'row4Update', 'uses' => 'FooterDynamicController@row4Update']);
Route::get('/add_blog', ['as' => 'add_blog', 'uses' => 'FooterDynamicController@add_blog']);
Route::post('savePresBlog', ['as' => 'savePresBlog', 'uses' => 'FooterDynamicController@savePresBlog']);
Route::get('/downLoadLogo/{path}', ['as' => 'downLoadLogo', 'uses' => 'FooterDynamicController@downLoadLogo']);
Route::get('/downLoadManage/{path}', ['as' => 'downLoadManage', 'uses' => 'FooterDynamicController@downLoadManage']);
Route::get('/downLoadPress/{path}', ['as' => 'downLoadPress', 'uses' => 'FooterDynamicController@downLoadPress']);

//City Admin Functionality
Route::get('/edit_city', ['as' => 'edit_city', 'uses' => 'FooterDynamicController@edit_city']);
Route::post('cityRowUpdate', ['as' => 'cityUpdate', 'uses' => 'FooterDynamicController@cityUpdate']);
Route::get('/add_city', ['as' => 'add_city', 'uses' => 'FooterDynamicController@add_city']);
Route::post('saveCitySingle', ['as' => 'saveCitySingle', 'uses' => 'FooterDynamicController@saveCitySingle']);
Route::get('/deleteCityOne/{id}', ['as' => 'deleteCityOne', 'uses' => 'FooterDynamicController@deleteCityOne']);




//Booking Reject By Admin

Route::get('/admin-reject/{id}/{user_id}', function ($id, $user_id) {
    if(Auth::check())
    { 
    App\Property::where('id', $id)->update(['property_booking_status' => 2]);
    $property = App\Property::where('id', $id)->get();
    App\BillingInfo::where('booking_id', $property[0]->booking_id)->update(['booking_status_host' => 2]);
    return redirect('/admin_dashboard');
    }
});





