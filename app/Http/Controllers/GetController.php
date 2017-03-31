<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\DynamicText;
use DB;

class GetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct(DynamicText $dynamic)
    {
        $this->dynamic = $dynamic;
    }

    public function getLoadBlog()
    {
       echo json_encode($this->dynamic->where('rows', 3)->where('type', 'press')->get());
       die;
    }

    public function getCityLoad()
    {
       // echo json_encode($this->dynamic->where('type', 'city')->get());
      $cities = $this->dynamic->where('type', 'city')->get();
      $city_price_list = array();
      foreach ($cities as $city) {
        $city_price = DB::table('properties')->where('plz_place', 'like', '%' . $city->title . '%')->where('price_per_night', DB::raw("(select min(`price_per_night`) from properties where plz_place like '%" . $city->title . "%')"))->get();
        if(count($city_price) > 0){
          array_push($city_price_list, $city_price[0]->price_per_night);
        }else{
          array_push($city_price_list, '');
        }
      }

      echo json_encode(['cities'=>$cities, 'price_list'=>$city_price_list]);
      die;
    }

    public function how_to_book()
    {
      $rows = $this->dynamic->where('type','book')->get()->toArray();
      return view('frontend.links.how-to-book')->with('rows', $rows);
    }

    public function help_footer()
    {
      $rows = $this->dynamic->where('type','help')->get()->toArray();
      return view('frontend.links.help-footer')->with('rows', $rows);
    }

    public function press()
    {
      $rows = $this->dynamic->where('type','press')->orderBy('created_at', 'desc')->get()->toArray();
      return view('frontend.links.press')->with('rows', $rows);
    }

}
