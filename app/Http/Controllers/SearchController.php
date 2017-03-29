<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Property;
use App\PropertyDate;
use App\Payment;
use App\BillingInfo;
use App\PropertyFeature;
use App\DynamicText;
use App\User;
use DB;
use Vsmoraes\Pdf\Pdf;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $pdf;

    public function __construct(Property $property, PropertyFeature $feature, Pdf $pdf, Payment $Payment, BillingInfo $billingInfo, Payment $payment, DynamicText $dynamicText, User $user)
    {
        $this->property = $property;
        $this->feature  = $feature;
        $this->pdf = $pdf;
        $this->billingInfo = $billingInfo;
        $this->payment = $payment;
        $this->dynamicText = $dynamicText;
        $this->user = $user;
        $this->per_page = 8;
        $this->helper = new \ApartHelper;
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $start_date = date('Y-m-d');
      $end_date   = "";
      $properties = $this->property->take(5)->where('booking_id', 0)->latest()->get();
      //$properties = $this->property->take(5)->where('booking_id', 0)->orderBy('start_date', 'desc')->get();
      //$properties = $this->return_filter($properties, $start_date, $end_date);
      $cities = $this->dynamicText->where('type','city')->get()->toArray();
      return view('frontend.home')->with('properties', $properties)->with('cities', $cities);
    }

    public function confirm($hash_key)
    {
      $user = $this->user;
      $properties = $this->property->take(5)->orderBy('start_date', 'desc')->get();
      $cities = $this->dynamicText->where('type','city')->get()->toArray();
      $single_user = $user->where('hash_key', $hash_key)->get();
      if(count($single_user) && $single_user[0]->user_type == 0)
      {
       $data = ['is_verified' => 1 , 'active' => 1, 'hash_key' => 0];
       $user->where('hash_key', $hash_key)->update($data);
       return view('frontend.home')->with('verify_mess', 1)->with('properties', $properties)->with('cities', $cities);
      }else if(count($single_user) && $single_user[0]->user_type == 1)
      {
       $data = ['is_verified' => 1 , 'active' => 0, 'hash_key' => 0];
       $user->where('hash_key', $hash_key)->update($data);
       return view('frontend.home')->with('properties', $properties)->with('cities', $cities);
      }else
       return redirect('/');
    }

    public function helloWorld()
    {
        $properties = $this->property->where('booking_id', 1)->get();
        $html = view('frontend.links.pdf-map', compact('properties'))->render();
        $filename = date('dmYhis').'booking.pdf';
        $this->pdf->load($html,  $size = 'A4', $orientation = 'portrait')->filename('bookings/'.$filename)->output();

        //return 'PDF saved';
         echo $html;
        die;
    }

   
    public function google_api()
      {
          $address = Input::get('address');
          try {
              $enaddress = urlencode($address);
              $url = "https://maps.googleapis.com/maps/api/geocode/json?&address=" . $enaddress;
              $data = json_decode(file_get_contents($url), true);
              //dd($data);
              $result = array();
              if($data['status'] != 'ZERO_RESULTS'){
                  if (!empty($data['results'][1])) {
                      $result['lat'] = $data['results'][1]['geometry']['location']['lat'];
                      $result['lng'] = $data['results'][1]['geometry']['location']['lng'];   
                  } 
                  else {
                      $result['lat'] = $data['results'][0]['geometry']['location']['lat'];
                      $result['lng'] = $data['results'][0]['geometry']['location']['lng'];
                  }
              }
              return $result;   
          } catch (\Exception $e) {
             dd($e);
          }
      }

     public function searchMap()
     {
       $city_where_met = explode(',', Input::get('address'))[0];
       $price = Input::get('price'); 
       $bedroom = Input::get('bedroom'); 
       $datepicker = Input::get('start_date');

       $enddate = Input::get('end_date');  

       $lat = Input::get('lat');  
       $lng = Input::get('lng');  
       
       $radius_km = Input::get('radius_km'); 
       
      if($city_where_met != "")
      {
        if($price == "")
        {
          $array[0] = 0;
          $array[1] = 10000;
        }else
        {
        $array = explode("-",$price);
        }
        
        if($bedroom == "")
        $bedroom = 8;
        
        if($datepicker == "")
        {
           $start_date = date('Y-m-d');
           $pass = '';
        }else
        {
            $start_date = date('Y-m-d',strtotime($datepicker));
            $pass = $start_date;
        }


        if($enddate == "")
        {
           $end_date = "";
           $pass_end = '';
        }else
        {
            $end_date = date('Y-m-d',strtotime($enddate));
            $pass_end = $end_date;
        }      
        

        if($bedroom >= 8){
        $porperties = Property::selectRaw("*, ( 6371 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance")->having("distance", "<", $radius_km )->where('start_date','<=', $start_date)->where('end_date','>=', $start_date)->where('apartment_for','<=' ,$bedroom)->whereBetween('price_per_night', [$array[0], $array[1]])->orderBy('created_at', 'DESC')->paginate($this->per_page);
        if(Input::get('start_date') == ""){
        }else {
          $porperties = $this->return_filter($porperties, $start_date, $end_date);
        }

        //  $porperties = $this->return_filter($porperties, $start_date, $end_date);
        }else{
         $porperties = Property::selectRaw("*, ( 6371 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance")->having("distance", "<", $radius_km )->where('start_date','<=', $start_date)->where('apartment_for','<=' ,$bedroom)->whereBetween('price_per_night', [$array[0], $array[1]])->orderBy('created_at', 'DESC')->paginate($this->per_page);
          $porperties = $this->return_filter($porperties, $start_date, $end_date); 
        }

        
       
        
      }
      if($city_where_met != "")
      {
       //$porperties = $this->property->orWhere('street', 'like', "%{$city_where_met}%")->get(); 
        if(count($porperties)>0){
          return view('frontend.search.search')->with('porperties', $porperties->appends(Input::except('page')))->with('city_where_met_location', $city_where_met)->with('some_place', Input::get('address'))->with('price', Input::get('price'))->with('bedroom', Input::get('bedroom'))->with('start_date', $pass)->with('radius', $radius_km)->with('end_date', $pass_end);
        }else{
          return view('frontend.search.search')->with('porperties', $porperties)->with('city_where_met_location', $city_where_met)->with('some_place', Input::get('address'))->with('price', Input::get('price'))->with('bedroom', Input::get('bedroom'))->with('start_date', $pass)->with('radius', $radius_km)->with('end_date', $pass_end);
        }
      }
      else
      {
       \Session::flash('message1', 'We could not find any locations with the name "". Please check the name and search again.'); 
       return back(); 
      }  
     }


     public function search_home_link()
     {
      
       $city_where_met = explode(',', Input::get('address'))[0];
       $price          = Input::get('price'); 
       $bedroom        = Input::get('bedroom'); 
       $datepicker     = Input::get('datepicker');  
       $end_date       = "";
       //  print_r(Input::all());
       //  die;
       // //print_r (explode("-",Input::get('price')));
      

      if($city_where_met != "")
      {
        if($price == "")
        {
          $array[0] = 0;
          $array[1] = 10000;
        }else
        {
        $array = explode("-",$price);
        }
        
        if($bedroom == "")
        $bedroom = 8;
        
        if($datepicker == "")
        {
           $start_date = date('Y-m-d');
           $pass = '';
        }else
        {
            $start_date = date('Y-m-d',strtotime($datepicker));
            $pass = $start_date;
        }    
        
        if($bedroom >= 8){
          $porperties = $this->property->where('start_date','<=', $start_date)->where('apartment_for','<=' ,$bedroom)->where(DB::raw('CONCAT_WS(" ", plz_place, street)'), 'like', "%{$city_where_met}%")->whereBetween('price_per_night', [$array[0], $array[1]])->orderBy('created_at', 'DESC')->paginate($this->per_page);
          if(Input::get('datepicker') == ""){
          }else {
            $porperties = $this->return_filter($porperties, $start_date, $end_date);
          }
        }else{
          $porperties = $this->property->where('start_date','<=', $start_date)->where('apartment_for','=' ,$bedroom)->where(DB::raw('CONCAT_WS(" ", plz_place, street)'), 'like', "%{$city_where_met}%")->whereBetween('price_per_night', [$array[0], $array[1]])->orderBy('created_at', 'DESC')->pagenate($this->per_page);
          $porperties = $this->return_filter($porperties);
        }

       
        
      }
      if($city_where_met != "")
      {
       //$porperties = $this->property->orWhere('street', 'like', "%{$city_where_met}%")->get(); 
        if(count($porperties)>0){
          return view('frontend.search.search')->with('porperties', $porperties->appends(Input::except('page')))->with('city_where_met_location', $city_where_met)->with('some_place', Input::get('address'))->with('price', Input::get('price'))->with('bedroom', Input::get('bedroom'))->with('start_date', $pass)->with('radius', 0)->with('end_date', '');
        }else{
          return view('frontend.search.search')->with('porperties', $porperties)->with('city_where_met_location', $city_where_met)->with('some_place', Input::get('address'))->with('price', Input::get('price'))->with('bedroom', Input::get('bedroom'))->with('start_date', $pass)->with('radius', 0)->with('end_date', '');
        }
      }
      else
      {
       \Session::flash('message1', 'We could not find any locations with the name "". Please check the name and search again.'); 
       return back(); 
      }  

     }

     public function return_filter($porperties, $start_date, $end_date)
     {
        $array_in = array();
        $count = 0;
        foreach($porperties as $key=>$val)
        {
          $pay = $this->payment->where('billing_id', $val->id)->orderBy('created_at', 'DESC')->get()->toArray();
          if(count($pay) == 1)
          {
            if(!$this->return_filter_checkout($pay[0]['id'], $start_date, $end_date))
            $array_in[$count] = $val->id;
            $count++;  
          }else if(count($pay) > 1)
          {
            foreach ($pay as $key => $value) {
              if(!$this->return_filter_checkout($pay[$key]['id'], $start_date, $end_date))
              $array_in[$count] = $val->id;
              $count++; 
              }
          }else {
            $array_in[$count] = $val->id;
            $count++;
          }
        
        }
        return $this->property->whereIn('id', $array_in)->paginate($this->per_page);

        
     }

     public function return_filter_checkout($pay, $start_date, $end_date)
     {

        if($end_date == "" && $start_date != ""){
          $billingInfo = $this->billingInfo->where('check_out','>=', date('Y-m-d'))->where('booking_id', $pay)->get()->toArray();
         
          foreach ($billingInfo as $key => $value) {
               $id = $value['id']; 
               if($this->return_filter_level_checkout($id, $start_date, $end_date) == 0)
               return 0;        
          }
          return 1;
        }else if($end_date != "" && $start_date != ""){
          $billingInfo = $this->billingInfo->where('check_out','>=', date('Y-m-d'))->where('booking_id', $pay)->get()->toArray();
         
          foreach ($billingInfo as $key => $value) {
               $id = $value['id']; 
               if($this->return_filter_level_checkout($id, $start_date, $end_date) == 0)
               return 0;        
          }
          echo $id;
          return 1;
        }else if($end_date == "" && $start_date != "")
        {
          return 0;
        }
     }

     public function return_filter_level_checkout($id, $start_date, $end_date)
     {
         if($start_date!= "" && $end_date == ""){
           $billingInfo = $this->billingInfo->where('id', $id)->get()->toArray();
           $paymentDate = $start_date;
           $contractDateBegin = $billingInfo[0]['check_in'];
           $contractDateEnd   = $billingInfo[0]['check_out'];

           if(($paymentDate >= $contractDateBegin) && ($paymentDate < $contractDateEnd))
           {
             return 1;
           }
           else
           {
             return 0; 
           }
         }else if($start_date!= "" && $end_date != ""){

           if(strstr($end_date, '/')){
              $dt = \DateTime::createFromFormat('y-d-m', explode('/', $end_date)[2].'-'.explode('/', $end_date)[0].'-'.explode('/', $end_date)[1])->format('Y-m-d');;
           }else
           {
              $dt=$end_date;
           }

           
          

           $billingInfo = $this->billingInfo->where('id', $id)->get()->toArray();
           $paymentDate = $start_date;
           $contractDateBegin = $billingInfo[0]['check_in'];
           $contractDateEnd   = $billingInfo[0]['check_out'];

           $end_check   = ($end_date >= $contractDateBegin) && ($end_date < $contractDateEnd);
           if(($paymentDate >= $contractDateBegin) && ($paymentDate < $contractDateEnd))
           {
             return 1;
           }
           else if($end_check == 1)
           {
             return 1; 
           }else
           {
             return 0;
           }
         }
     }

     public function search()
     {
       $city_where_met = explode(',', Input::get('city_where_met'))[0];
       $price          = Input::get('price'); 
       $bedroom        = Input::get('bedroom'); 
       $datepicker     = Input::get('datepicker');  
       $end_date       = "";
       
       if($city_where_met != "")
       {
        if($price == "")
        {
          $array[0] = 0;
          $array[1] = 10000;
        }else
        {
        $array = explode("-",$price);
        }
        
        if($bedroom == "")
          $bedroom = 8;
        
        if($datepicker == "")
        {
           $start_date = date('Y-m-d');
           $pass = '';
        }else
        {
            $start_date = \DateTime::createFromFormat('d/m/y H:i', $datepicker." 00:00")->format('Y-m-d');//date('Y-m-d',strtotime($datepicker));
            $pass = $start_date;
        }    
        
       if($bedroom >= 8){
          // $porperties = $this->property->where('apartment_for','<=' ,$bedroom)->where(DB::raw('CONCAT_WS(" ", plz_place, street)'), 'like', "%{$city_where_met}%")->where('start_date','<=', $start_date)->where('end_date','>=', $start_date)->whereBetween('price_per_night', [$array[0], $array[1]])->orderBy('created_at', 'DESC')->get();
          $porperties = $this->property->where('apartment_for','<=' ,$bedroom)->where(DB::raw('CONCAT_WS(" ", plz_place, street)'), 'like', "%{$city_where_met}%")->whereBetween('price_per_night', [$array[0], $array[1]])->orderBy('created_at', 'DESC')->paginate($this->per_page);

          if(Input::get('datepicker') == ""){
          }else {
            $porperties = $this->return_filter($porperties, $start_date, $end_date);
          }
        }else{
          //$porperties = $this->property->where('apartment_for','<=' ,$bedroom)->where(DB::raw('CONCAT_WS(" ", plz_place, street)'), 'like', "%{$city_where_met}%")->where('start_date','<=', $start_date)->where('end_date','>=', $start_date)->whereBetween('price_per_night', [$array[0], $array[1]])->orderBy('created_at', 'DESC')->get();
          $porperties = $this->property->where('apartment_for','>=' ,$bedroom)->where(DB::raw('CONCAT_WS(" ", plz_place, street)'), 'like', "%{$city_where_met}%")->whereBetween('price_per_night', [$array[0], $array[1]])->orderBy('created_at', 'DESC')->paginate($this->per_page);

          if(Input::get('datepicker') == ""){
          }else {
            $porperties = $this->return_filter($porperties, $start_date, $end_date);
          }
        }  
      }
      if($city_where_met != "")
      {
       //$porperties = $this->property->orWhere('street', 'like', "%{$city_where_met}%")->get(); 
        if(count($porperties)>0){
          return view('frontend.search.search')->with('porperties', $porperties->appends(Input::except('page')))->with('city_where_met_location', $city_where_met)->with('some_place', Input::get('city_where_met'))->with('price', Input::get('price'))->with('bedroom', Input::get('bedroom'))->with('start_date', $pass)->with('radius', 0)->with('end_date', '');;
        }else{
          return view('frontend.search.search')->with('porperties', $porperties)->with('city_where_met_location', $city_where_met)->with('some_place', Input::get('city_where_met'))->with('price', Input::get('price'))->with('bedroom', Input::get('bedroom'))->with('start_date', $pass)->with('radius', 0)->with('end_date', '');;
        }
      }
      else
      {
       \Session::flash('message1', 'We could not find any locations with the name "". Please check the name and search again.'); 
       return back(); 
      }  

     }

    public function getEndDateCalendar(Request $requset)
    {
        try {

            $finalDate = '';
            $start_date = date('Y-m-d', strtotime($requset->start_date)); 
            $end_date = date('Y-m-d', strtotime($requset->end_date));

            $date = $this->helper->getInBetweenDates($start_date, $end_date);

            array_push($date, $end_date);

            if (count($date) > 0) { 
                $lastIndex = count($date) - 1;
                foreach ($date as $key => $val)
                {
                  if ($key == $lastIndex) {
                    $finalDate = $finalDate.date('d/m/Y', strtotime($val));
                  }  
                  if ($key != $lastIndex) {
                      $finalDate = $finalDate.date('d/m/Y', strtotime($val)).",";
                  }
                }
            }

            $dates = json_encode(explode(',', $finalDate));

            return $dates;

        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function search_search()
    {

        $city_where_met = explode(',', Input::get('city_where_met_search'))[0];

        // getting all search options from search form
        $search_keys = Input::get();
        
        // making more where clauses
        $where = '1';
        if($search_keys['bedroom1'] != null) {
          $where .= ' AND bedroom=' . $search_keys['bedroom1'];
        }
        
        if($search_keys['bathroom'] != null){
          $where .= ' AND bathroom=' . $search_keys['bathroom'];
        }
        if($search_keys['bed'] != null){
          $where .= ' AND bed=' . $search_keys['bed'];
        }
        if($search_keys['lining_space'] != null){
          $where .= ' AND lining_space>=' . $search_keys['lining_space'];
        }
        if($search_keys['property_type_id'] != null){
          $where .= ' AND property_type_id=' . $search_keys['property_type_id'];
        }

        // making features list of more search
        $more_search = array();
        for($i = 1; $i <= 22; $i++){
          $more_key = 'feature_' . $i;
          if(isset($search_keys[$more_key]) && $search_keys[$more_key] != null){
            array_push($more_search, $i);
          }
        }
        // making sql for more options->features
        $where_feature = "1";
        
        foreach($more_search as $one) {

          $where_feature .= " AND $one IN (select feature_id from property_features where property_id=properties.id)";
          
        }
        $price      = Input::get('price'); 
        $bedroom    = Input::get('bedroom'); 
        $datepicker = Input::get('start_date'); 
        $end_date   = Input::get('end_date'); 

        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        
        $porperties = [];

        if ($city_where_met != "")
        {
            if ($price == "")
            {
                $array[0] = 0;
                $array[1] = 10000;
            }else
            {
                $array = explode("-",$price);
            }
        
            if ($bedroom == "")
                $bedroom = 8;

            if ($datepicker == "")
            {
                $start_date = date('Y-m-d');
                $pass = '';
            }else
            {
                $start_date = \DateTime::createFromFormat('d/m/y H:i', $datepicker." 00:00")->format('Y-m-d');
                $pass = $start_date ;
            } 

            if ($end_date == "")
            {
                $date = strtotime("+1 day");
                $end_date_search = "";
                
                $pass_end = '';
            }else
            {
                $end_date_search = \DateTime::createFromFormat('d/m/y H:i', $end_date." 00:00")->format('Y-m-d');
                $pass_end = $end_date_search;
           
            }   

            if ($bedroom >= 8 && $end_date_search == "")
            { 
                $porperties1 = $this->property->where('apartment_for','<=' ,$bedroom)->where(DB::raw('CONCAT_WS(" ", plz_place, street)'), 'like', "%{$city_where_met}%")->whereBetween('price_per_night', [$array[0], $array[1]])->whereraw($where)->whereraw($where_feature)->orderBy('created_at', 'DESC')->paginate($this->per_page); 
                // $porperties = $this->property->where('apartment_for','<=' ,$bedroom)->where(DB::raw('CONCAT_WS(" ", plz_place, street)'), 'like', "%{$city_where_met}%")->where('start_date','<=', $start_date)->where('end_date','>=', $start_date)->whereBetween('price_per_night', [$array[0], $array[1]])->orderBy('created_at', 'DESC')->get();
                // if(Input::get('start_date') == ""){
                //   }else {
                    //   $porperties = $this->return_filter($porperties, $start_date, $end_date);
                //       }
          
                /**************NEW AVALIABLITY FUNCTIONALITY STARTS HERE*****************/ 
                if (count($porperties1) > 0 && $this->helper->getPropertiesByDate($porperties1, $start_date, $end_date_search)) {
                    $porperties = $porperties1;
                }
                /**************NEW AVALIABLITY FUNCTIONALITY ENDS HERE*****************/
            }else if ($bedroom < 8 && $end_date_search == "")
            {
                $porperties1 = $this->property->where('apartment_for','>=' ,$bedroom)->where(DB::raw('CONCAT_WS(" ", plz_place, street)'), 'like', "%{$city_where_met}%")->whereBetween('price_per_night', [$array[0], $array[1]])->whereraw($where)->whereraw($where_feature)->orderBy('created_at', 'DESC')->paginate($this->per_page); 
                // $porperties = $this->property->where('apartment_for','<=' ,$bedroom)->where(DB::raw('CONCAT_WS(" ", plz_place, street)'), 'like', "%{$city_where_met}%")->where('start_date','<=', $start_date)->where('end_date','>=', $start_date)->whereBetween('price_per_night', [$array[0], $array[1]])->orderBy('created_at', 'DESC')->get();
                  // if(Input::get('start_date') == ""){
                  //   }else {
                  //   $porperties = $this->return_filter($porperties, $start_date, $end_date);
                  //   }
                /**************NEW AVALIABLITY FUNCTIONALITY STARTS HERE*****************/ 
                if (count($porperties1) > 0 && $this->helper->getPropertiesByDate($porperties1, $start_date, $end_date_search)) {
                    $porperties = $porperties1; 
                }
                /**************NEW AVALIABLITY FUNCTIONALITY ENDS HERE*****************/
            }else if($bedroom >= 8 && $end_date_search != "")
            {
                $porperties1 = $this->property->where('apartment_for','>=' ,$bedroom)->where(DB::raw('CONCAT_WS(" ", plz_place, street)'), 'like', "%{$city_where_met}%")->whereBetween('price_per_night', [$array[0], $array[1]])->whereraw($where)->whereraw($where_feature)->orderBy('created_at', 'DESC')->paginate($this->per_page); 
                if ($start_date > $end_date_search) 
                {
                    // $porperties = $this->property->where('apartment_for','<=' ,$bedroom)->where(DB::raw('CONCAT_WS(" ", plz_place, street)'), 'like', "%{$city_where_met}%")->where('start_date','<=', $start_date)->where('end_date','>=', $start_date)->whereBetween('price_per_night', [$array[0], $array[1]])->orderBy('created_at', 'DESC')->get(); 
           
                    /**************NEW AVALIABLITY FUNCTIONALITY STARTS HERE*****************/ 
                    if (count($porperties1) > 0 && $this->helper->getPropertiesByDate($porperties1, $start_date, $end_date_search))
                    {
                        $porperties = $porperties1;
                    }
                    /**************NEW AVALIABLITY FUNCTIONALITY ENDS HERE*****************/
                    $pass_end = "";
                }else 
                {
                    $porperties1 = $this->property->where('apartment_for','>=' ,$bedroom)->where(DB::raw('CONCAT_WS(" ", plz_place, street)'), 'like', "%{$city_where_met}%")->whereBetween('price_per_night', [$array[0], $array[1]])->whereraw($where)->whereraw($where_feature)->orderBy('created_at', 'DESC')->paginate($this->per_page);  
                    // $porperties = $this->property->where('apartment_for','<=' ,$bedroom)->where(DB::raw('CONCAT_WS(" ", plz_place, street)'), 'like', "%{$city_where_met}%")->where('start_date','<=', $start_date)->where('end_date','>=', $end_date_search)->whereBetween('price_per_night', [$array[0], $array[1]])->orderBy('created_at', 'DESC')->get(); 
            
                    /**************NEW AVALIABLITY FUNCTIONALITY STARTS HERE*****************/ 
                    if (count($porperties1) > 0 && $this->helper->getPropertiesByDate($porperties1, $start_date, $end_date_search)) 
                    {
                        $porperties = $porperties1;
                    }
                    /**************NEW AVALIABLITY FUNCTIONALITY ENDS HERE*****************/ 
                }
                //echo $start_date.":".$end_date; die;
                //$porperties = $this->return_filter($porperties, $start_date, $end_date); 
            }else
            {  
                $porperties1 = $this->property->where('apartment_for', '>=', $bedroom)->where(DB::raw('CONCAT_WS(" ", plz_place, street)'), 'like', "%{$city_where_met}%")->whereBetween('price_per_night', [$array[0], $array[1]])->whereraw($where)->whereraw($where_feature)->orderBy('created_at', 'DESC')->paginate($this->per_page); 
                // $porperties = $this->property->where('apartment_for','<=' ,$bedroom)->where(DB::raw('CONCAT_WS(" ", plz_place, street)'), 'like', "%{$city_where_met}%")->where('start_date','<=', $start_date)->where('end_date','>=', $end_date_search)->whereBetween('price_per_night', [$array[0], $array[1]])->orderBy('created_at', 'DESC')->get(); 
                //$porperties = $this->return_filter($porperties, $start_date, $end_date);
          
                /**************NEW AVALIABLITY FUNCTIONALITY STARTS HERE*****************/ 
                if (count($porperties1) > 0 && $this->helper->getPropertiesByDate($porperties1, $start_date, $end_date_search)) 
                {
                    $porperties = $porperties1;
                }
                /**************NEW AVALIABLITY FUNCTIONALITY ENDS HERE*****************/ 
            }
            // When $porperties has list, appends 'get' -> parameters into $porperties variable.
            if(count($porperties) > 0){ // append 'get parameters' into $porperties
              return view('frontend.search.search')->with('porperties', $porperties->appends(Input::except('page')))->with('city_where_met_location', $city_where_met)->with('some_place', Input::get('city_where_met_search'))->with('price', Input::get('price'))->with('bedroom', Input::get('bedroom'))->with('start_date', $pass)->with('radius', 0)->with('end_date', $pass_end);
            }else{
              return view('frontend.search.search')->with('porperties', $porperties)->with('city_where_met_location', $city_where_met)->with('some_place', Input::get('city_where_met_search'))->with('price', Input::get('price'))->with('bedroom', Input::get('bedroom'))->with('start_date', $pass)->with('radius', 0)->with('end_date', $pass_end);
            }
        }else
        {
            \Session::flash('message1', 'We could not find any locations with the name "". Please check the name and search again.'); 
            return back(); 
        }  

    }

    private function search_more_option($properties, $more_keys){
      $last_result = $properties;
      if($more_keys['bedroom1'] != null) {
        $last_result = $last_result->where('bedroom', '=', $more_keys['bedroom1'])->get();
      }

      if($more_keys['bathroom'] != null){
        $last_result = $last_result->where('bathroom', '=', $more_keys['bathroom'])->get();
      }
      if($more_keys['bed'] != null){
        $last_result = $last_result->where('bed', '=', $more_keys['bed'])->get();
      }
      if($more_keys['lining_space'] != null){
        $last_result = $last_result->where('lining_space', '>=', $more_keys['lining_space'])->get();
      }
      if($more_keys['property_type_id'] != null){
        $last_result = $last_result->where('property_type_id', '=', $more_keys['property_type_id'])->get();
      }

      return $last_result;

    }
}