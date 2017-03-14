<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\DynamicText;

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
       echo json_encode($this->dynamic->where('type', 'city')->get());
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
      $rows = $this->dynamic->where('type','press')->get()->toArray();
      return view('frontend.links.press')->with('rows', $rows);
    }

}
