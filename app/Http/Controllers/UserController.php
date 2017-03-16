<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\User as User;
use Illuminate\Support\Facades\Input;
use Image as NameImage;
use App\Account;
use App\Image as ImageModel;
use App\Property;
use App\PropertyDate;
use App\Payment;
use App\PropertyFeature;
use App\BillingInfo;
use App\Message;
use DB;
use Image;
use App\Ical;
use Vsmoraes\Pdf\Pdf;
use ical2scheduler\Api\Refund;
use App\Event as IcalEvent;
use Carbon\Carbon;
use Response;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $pdf;
    public function __construct(User $user, Account $account, ImageModel $image_model, Property $property, PropertyFeature $feature, Payment $payment, BillingInfo $billingInfo, Pdf $pdf, Pdf $pdf1, IcalEvent $icalevent, Message $message)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->account = $account;
        $this->image_model = $image_model;
        $this->property = $property;
        $this->feature  = $feature;
        $this->payment  = $payment;
        $this->billingInfo = $billingInfo;
        $this->helper = new \ApartHelper;
        $this->pdf = $pdf; //booking pdf
        $this->pdf1 = $pdf1; //service fee pdf
        $this->icalevent = $icalevent;
        $this->message = $message;
    }

    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function search()
    {
      echo "Come";
      die;
    }
    public function deleteSingleImageTest()
    {
        $id = Input::get('imageid');
        return DB::table('images')->where('id', $id)->delete();
        die;
    }

    public function edit_Profile_tenant()
    {
     
      $user_data = $this->user->where('id', Auth::user()->id)->get();
      return view('frontend.profile.tenant')->with('user_data', $user_data);
    }



    public function edit_Profile_host()
    {
      $user_data = $this->user->where('id', Auth::user()->id)->get();
      $properties_count = count($this->property->where('user_id', Auth::user()->id)->where('booking_id', '!=', 0)->get());
      return view('frontend.profile.edit')->with('user_data', $user_data)->with('booking_count', $properties_count);
    }


  public function saveIcalTemporary()
  {
     foreach(Input::all() as $key=>$data)
     {
     $type = explode(':',explode(';', $data['datajson'])[0])[1];
     if($type == 'text/calendar')
     $extention = '.ics';

     list($typepp, $data['datajson']) = explode(';', $data['datajson']);
     list(, $data['datajson']) = explode(',', $data['datajson']);
     $filenamepp = 'pp' . date('Ymdhis') .$key.'ical'.$extention; 
     $uploadpp = base_path().'/public/images/ical/'.$filenamepp;
     $imagepp = base64_decode($data['datajson']);
     file_put_contents($uploadpp, $imagepp);

     $ical_data = ['session_id' => $data['_token'],'path' => $filenamepp];
    //print_r($image_data);
     $this->ical->create($ical_data);
     $exporter = new ICalExporter();

     $events = $exporter->toHash(file_get_contents('https://calendar.google.com/calendar/ical/a8j67iob725kdpn7hjlv8kc3pc%40group.calendar.google.com/public/basic.ics'));

     echo json_encode(array_values($events));
     die;
    
    }
  }    

   public function saveEditImagesTemporary()
  {

   foreach(Input::all() as $key=>$data)
   {
      $type = explode(':',explode(';', $data['profile_pic'])[0])[1];
      if($type == 'image/jpeg')
      $extention = 'jpg';
      else if($type == 'image/png')
      $extention = 'png';
      else if($type == 'image/gif')
      $extention = 'gif';
      else
      $extention = 'jpg'; 

      list($typepp, $data['profile_pic']) = explode(';', $data['profile_pic']);
      list(, $data['profile_pic']) = explode(',', $data['profile_pic']);
      $filenamepp = 'pp' . date('Ymdhis') .$key.'profile.'.$extention; 
      $uploadpp = base_path().'/public/images/profile/'.$filenamepp;
      $imagepp = base64_decode($data['profile_pic']);
      file_put_contents($uploadpp, $imagepp);

      list($width, $height) = getimagesize($uploadpp);

      $uploadpp_thumb = base_path().'/public/images/thumb/'.$filenamepp;
      if($width > 3000 && $height > 2000)
      $imagedata = NameImage::make( file_get_contents($uploadpp))->crop(1500, 1500)->save($uploadpp_thumb);
      else if($width > 1500 && $height > 900)
      $imagedata = NameImage::make( file_get_contents($uploadpp))->crop(900, 900)->save($uploadpp_thumb); 
      else 
      $imagedata = NameImage::make( file_get_contents($uploadpp))->save($uploadpp_thumb);   



      $image_data = ['session_id' => $data['_token'],'path' => $filenamepp, 'property_id' => $data['property_id']];
      //print_r($image_data);
      $this->image_model->create($image_data);

   } 
    die;
  }  

  public function saveImagesTemporary()
  {

   foreach(Input::all() as $key=>$data)
   {
   $type = explode(':',explode(';', $data['profile_pic'])[0])[1];
   if($type == 'image/jpeg')
   $extention = 'jpg';
   else if($type == 'image/png')
   $extention = 'png';
   else if($type == 'image/gif')
   $extention = 'gif';
   else
   $extention = 'jpg'; 
    
    list($typepp, $data['profile_pic']) = explode(';', $data['profile_pic']);
    list(, $data['profile_pic']) = explode(',', $data['profile_pic']);
    $filenamepp = 'pp' . date('Ymdhis') .$key.'profile.'.$extention; 
    $uploadpp = base_path().'/public/images/profile/'.$filenamepp;
    $imagepp = base64_decode($data['profile_pic']);
    file_put_contents($uploadpp, $imagepp);
    list($width, $height) = getimagesize($uploadpp);
    
    $uploadpp_thumb = base_path().'/public/images/thumb/'.$filenamepp;
    if($width > 3000 && $height > 2000)
    $imagedata = NameImage::make( file_get_contents($uploadpp))->crop(1500, 1500)->save($uploadpp_thumb);
    else if($width > 1500 && $height > 900)
    $imagedata = NameImage::make( file_get_contents($uploadpp))->crop(900, 900)->save($uploadpp_thumb); 
    else 
    $imagedata = NameImage::make( file_get_contents($uploadpp))->save($uploadpp_thumb);
    
    $image_data = ['session_id' => $data['_token'],'path' => $filenamepp];
    //dd($image_data);
    //print_r($image_data);
    $this->image_model->create($image_data);

   } 
    die;
  }

  public function saveEditHostProperty()
  {
    
    $property_id = Input::get('property_id');
    //$property_data['_token'] = Input::get('_token');
    $property_data['plz_place'] = Input::get('plz_place');
    $property_data['street'] = Input::get('street');
    $property_data['lat'] = Input::get('lat');
    $property_data['lng'] = Input::get('lng');
    $property_data['lng'] = Input::get('lng');
    $property_data['bedroom'] = Input::get('bedroom');
    $property_data['bathroom'] = Input::get('bathroom');
    $property_data['bed'] = Input::get('bed');
    $property_data['apartment_for'] = Input::get('apartment_for');
    $property_data['lining_space'] = Input::get('lining_space');
    $property_data['property_type_id'] = Input::get('property_type_id');
    $property_data['reference'] = Input::get('reference');
    $property_data['price_per_night'] = Input::get('price_per_night');
    $property_data['price_per_week'] = Input::get('price_per_week');
    $property_data['cleaning_fee'] = Input::get('cleaning_fee');
    $property_data['vat_number'] = Input::get('vat_number');
    //$property_data['start_date'] = date(,Input::get('start_date')); 
    //changes
    // $property_data['start_date'] = \DateTime::createFromFormat('d/m/y H:i', Input::get('start_date')." 00:00")->format('Y-m-d');
    // $property_data['end_date'] = \DateTime::createFromFormat('d/m/y H:i', Input::get('end_date')." 00:00")->format('Y-m-d');
    $property_data['min_stay'] = Input::get('min_stay');
    $property_data['cancel_day'] = Input::get('cancel_day');
    $property_data['cancel_fee'] = Input::get('cancel_fee');
    $property_data['title'] = Input::get('title');
    $property_data['description'] = Input::get('description');
    $property_data['ical_path'] = Input::get('ical_path');
    $this->property->where('id', $property_id)->update($property_data);

    $drop_ranges = json_decode(Input::get('drop_ranges'));

    if (Input::get('unselected')) {
      $unSelectedDates = explode(',', Input::get('unselected'));

      foreach ($unSelectedDates as $date) {
        PropertyDate::where([
            ['selected_date', '=', $date],
            ['property_id', '=', $property_id]
          ])->delete();
      }
    }

    if (Input::get('ranges')) { 
      $ranges = json_decode(Input::get('ranges'));

      if (Input::get('delete_dates')) {
        $delete_dates = json_decode(Input::get('delete_dates'));
        foreach ($delete_dates as $date) { 
            $key = array_search($date, $ranges);
            unset($ranges[$key]);
          }
      }

      foreach ($ranges as $range) { 
        $start = $range->start;
        $end = $range->end;
        $selected_date[] = $this->helper->getInBetweenDates($start, $end);
      }

      if ($drop_ranges) {
        foreach ($drop_ranges as $dates) { 
          $date = date('Y-m-d', strtotime($dates->start));
          if (!in_array($date, $selected_date[0])) {
            array_push($selected_date[0], $date);
          }
        }
      } 

      foreach ($selected_date as $dates) {
          foreach ($dates as $date) {
            PropertyDate::create([
                'property_id'     => $property_id,
                'selected_date'   => $date
            ]);
          }
      }
    } else { 
      $selected_date = array();
      if ($drop_ranges) {
        foreach ($drop_ranges as $dates) { 
          $date = date('Y-m-d', strtotime($dates->start));
          //if (!in_array($date, $selected_date[0])) {
            array_push($selected_date, $date);
          //}
        }
      } 
      //dd($selected_date);
      if (count($selected_date) > 0) {
        foreach ($selected_date as $dates) {
          //foreach ($dates as $date) {
            PropertyDate::create([
                'property_id'     => $property_id,
                'selected_date'   => $dates
            ]);
          //}
      }
      }
      
    }

    $this->feature->where('property_id', $property_id)->delete();

    //base_path().'/public/images/
    $im = imagecreatefrompng(base_path().'/public/images/'.'map-marker.png');
    if ( $im==NULL )
    {
          echo "Cannot Initialize new GD image stream";
          die('Cannot Initialize new GD image stream');
    }
      
      // create a text colour
    $background = imagecolorallocate( $im, 255, 0, 0 );
    $text_color = imagecolorallocate($im, 255, 255, 255 );
      
      // write some text into the image
    //imagestring($im, 6,10, 10, 'CHF '.intVal($property_data['price_per_night']), $text_color);

    imagestring($im, 6,15, 15, 'CHF', $text_color);

    $x =     ceil(log10(intVal($property_data['price_per_night'])));
    if($property_data['price_per_night'] == 10)
    $x = 2;
    if($property_data['price_per_night'] == 100)
    $x = 3;
    if($property_data['price_per_night'] == 1000)
    $x = 4;
    if($property_data['price_per_night'] == 10000)
    $x = 5;  

    if($x == 1)
    imagestring($im, 6,25, 30, intVal($property_data['price_per_night']), $text_color);
    if($x == 2)
    imagestring($im, 6,20, 30, intVal($property_data['price_per_night']), $text_color);
    if($x == 3)
    imagestring($im, 6,15, 30, intVal($property_data['price_per_night']), $text_color);
    if($x == 4)
    imagestring($im, 6,10, 30, intVal($property_data['price_per_night']), $text_color);
    if($x == 5)
    imagestring($im, 6,5, 30, intVal($property_data['price_per_night']), $text_color);
      //imagestring($im, 6,10, 30, 'AVAILABLE', $text_color);

    /*
       Marker_Red next
    */

    $im_red = imagecreatefrompng(base_path().'/public/images/'.'map-marker_red.png');
    if ( $im_red==NULL )
    {
          echo "Cannot Initialize new GD image stream";
          die('Cannot Initialize new GD image stream');
    }
      
      // create a text colour
    $background = imagecolorallocate( $im_red, 255, 0, 0 );
    $text_color = imagecolorallocate($im_red, 255, 255, 255 );
      
      // write some text into the image
    //imagestring($im, 6,10, 10, 'CHF '.intVal($property_data['price_per_night']), $text_color);

    imagestring($im_red, 6,15, 15, 'CHF', $text_color);

    $x =     ceil(log10(intVal($property_data['price_per_night'])));

    if($property_data['price_per_night'] == 10)
    $x = 2;
    if($property_data['price_per_night'] == 100)
    $x = 3;
    if($property_data['price_per_night'] == 1000)
    $x = 4;
    if($property_data['price_per_night'] == 10000)
    $x = 5;  
   
    
    if($x == 1)
    imagestring($im_red, 6,25, 30, intVal($property_data['price_per_night']), $text_color);
    if($x == 2)
    imagestring($im_red, 6,20, 30, intVal($property_data['price_per_night']), $text_color);
    if($x == 3)
    imagestring($im_red, 6,15, 30, intVal($property_data['price_per_night']), $text_color);
    if($x == 4)
    imagestring($im_red, 6,10, 30, intVal($property_data['price_per_night']), $text_color);
    if($x == 5)
    imagestring($im_red, 6,5, 30, intVal($property_data['price_per_night']), $text_color);   
      
      //save the image to disk
    $path = public_path('product/');
    $path_red = public_path('product_red/');
    $unqiue_path = date('YmdHis').'product.png';
    imagesavealpha($im, true);
    $color = imagecolorallocatealpha($im, 0, 0, 0, 127);
    imagefill($im, 0, 0, $color);
    imagepng($im,  $path.$unqiue_path);
    $this->property->where('id', $property_id)->update(['icon_path' => $unqiue_path]);

    imagesavealpha($im_red, true);
    $color = imagecolorallocatealpha($im_red, 0, 0, 0, 127);
    imagefill($im_red, 0, 0, $color);
    imagepng($im_red,  $path_red.$unqiue_path);
    $this->property->where('id', $property_id)->update(['icon_path' => $unqiue_path]);
      
      // we dont need the image anymore
    imagedestroy($im);

    
    $property_data['checkboxvar'] = Input::get('checkboxvar');
    foreach( $property_data['checkboxvar'] as $key=>$val)
    {
      $feature = ['feature_id' => $val, 'property_id' => $property_id];
      $this->feature->create($feature);
    }
   
    
    
    return redirect('listing')->with('message','Property Detail Updated Successfully')->with('color','green');;
  }

  public function uniqueReference()
  {
    $property_data['_token'] = Input::get('_token');
    $property_data['reference'] = Input::get('reference');
    $val = $this->property->where('reference', $property_data['reference'])->get();
    echo count($val);
    die;
  }


  public function uniqueEditReference()
  {
    $property_data['_token'] = Input::get('_token');
    $property_data['reference'] = Input::get('reference');
    $property_data['id'] = intVal(Input::get('id'));
    $val = $this->property->where('id','!=',$property_data['id'])->where('reference', $property_data['reference'])->get();
    echo count($val);
    die;
  }



  public function saveHostProperty()
  {
    //dd(Input::get());
    $property_data['_token'] = Input::get('_token');
    $property_data['plz_place'] = Input::get('plz_place');
    $property_data['street'] = Input::get('street');
    $property_data['lat'] = Input::get('lat');
    $property_data['lng'] = Input::get('lng');
    $property_data['country_id'] = Input::get('country');
    $property_data['bedroom'] = Input::get('bedroom');
    $property_data['bathroom'] = Input::get('bathroom');
    $property_data['bed'] = Input::get('bed');
    //$property_data['vat_number'] = Input::get('vat_number');
    $property_data['apartment_for'] = Input::get('apartment_for');
    $property_data['lining_space'] = Input::get('lining_space');
    $property_data['property_type_id'] = Input::get('property_type_id');
    $property_data['reference'] = Input::get('reference');
    $property_data['price_per_night'] = Input::get('price_per_night');
    $property_data['price_per_week'] = Input::get('price_per_week');
    $property_data['cleaning_fee'] = Input::get('cleaning_fee');
    //$property_data['start_date'] = date(,Input::get('start_date'));
    
    /***************changes******************/ 
    // $property_data['start_date'] = \DateTime::createFromFormat('d/m/y H:i', Input::get('start_date')." 00:00")->format('Y-m-d'); 
    // $property_data['end_date'] = \DateTime::createFromFormat('d/m/y H:i', Input::get('end_date')." 00:00")->format('Y-m-d');
    /***************changes******************/ 

    $property_data['min_stay'] = Input::get('min_stay');
    $property_data['cancel_day'] = Input::get('cancel_day');
    $property_data['cancel_fee'] = Input::get('cancel_fee');
    $property_data['title'] = Input::get('title');
    $property_data['description'] = Input::get('description');
    $property_data['ical_path'] = Input::get('ical_path');
    $property_data['user_id'] = Auth::user()->id;

    $ranges = json_decode(Input::get('ranges'));
    $drop_ranges = json_decode(Input::get('drop_ranges'));
   
    if (Input::get('delete_dates')) {
      $delete_dates = json_decode(Input::get('delete_dates'));
      foreach ($delete_dates as $date) { 
          $key = array_search($date, $ranges);
          unset($ranges[$key]);
        }
    }

    $property_id = 0;

    if ($ranges) {

      foreach ($ranges as $range) { 
        $start = $range->start;
        $end = $range->end;
        $selected_date[] = $this->helper->getInBetweenDates($start, $end);
      }

      if ($drop_ranges) {
        foreach ($drop_ranges as $dates) { 
          $date = date('Y-m-d', strtotime($dates->start));
          if (!in_array($date, $selected_date[0])) {
            array_push($selected_date[0], $date);
          }
        }
      } 
      $property_id = $this->property->create($property_data)->id;

      foreach ($selected_date as $dates) {
          foreach ($dates as $date) {
            PropertyDate::create([
                'property_id'     => $property_id,
                'selected_date'   => $date
            ]);
          }
      }

    } else {
      if ($drop_ranges) {
        $selected_date = array();
        foreach ($drop_ranges as $dates) { 
          $date = date('Y-m-d', strtotime($dates->start));
          //if (!in_array($date, $selected_date[0])) {
            array_push($selected_date, $date);
          //}
        }
        $property_id = $this->property->create($property_data)->id;

        foreach ($selected_date as $dates) {
            //foreach ($dates as $date) {
              PropertyDate::create([
                  'property_id'     => $property_id,
                  'selected_date'   => $dates
              ]);
            //}
        }
      }  
    }

    if ($property_id == 0) {

      $property_id = $this->property->create($property_data)->id;
    }
//dd($selected_date);
    //dd($selected_date);

    if($property_id)
    {
      if($property_data['ical_path'] != "")
      {
         $exporter = new ICalExporter();

         $events = $exporter->toHash(file_get_contents($property_data['ical_path']));
     
         foreach($events as $event)
         {
            $event_save = ['event_id' => $event['event_id'], 'start_date' => date('Y-m-d h:i:s',strtotime($event['start_date'])),  'rec_type' => $event['rec_type'],'end_date' => date('Y-m-d h:i:s',strtotime($event['end_date'])), 'title' => $event['text'], 'event_pid' => $event['event_pid'], 'event_length' => $event['event_length'], 'property_id' => $property_id];
            $this->icalevent->create($event_save);
         }
      }
      $im = imagecreatefrompng(base_path().'/public/images/'.'map-marker.png');
    if ( $im==NULL )
    {
          echo "Cannot Initialize new GD image stream";
          die('Cannot Initialize new GD image stream');
    }
      
      // create a text colour
    $background = imagecolorallocate( $im, 255, 0, 0 );
    $text_color = imagecolorallocate($im, 255, 255, 255 );
      
      // write some text into the image
    //imagestring($im, 6,10, 10, 'CHF '.intVal($property_data['price_per_night']), $text_color);

    imagestring($im, 6,15, 15, 'CHF', $text_color);

    $x =     ceil(log10(intVal($property_data['price_per_night'])));
    if($property_data['price_per_night'] == 10)
    $x = 2;
    if($property_data['price_per_night'] == 100)
    $x = 3;
    if($property_data['price_per_night'] == 1000)
    $x = 4;
    if($property_data['price_per_night'] == 10000)
    $x = 5; 

    if($x == 1)
    imagestring($im, 6,25, 30, intVal($property_data['price_per_night']), $text_color);
    if($x == 2)
    imagestring($im, 6,20, 30, intVal($property_data['price_per_night']), $text_color);
    if($x == 3)
    imagestring($im, 6,15, 30, intVal($property_data['price_per_night']), $text_color);
    if($x == 4)
    imagestring($im, 6,10, 30, intVal($property_data['price_per_night']), $text_color);
    if($x == 5)
    imagestring($im, 6,5, 30, intVal($property_data['price_per_night']), $text_color);
      //imagestring($im, 6,10, 30, 'AVAILABLE', $text_color);

    /*
       Marker_Red next
    */

    $im_red = imagecreatefrompng(base_path().'/public/images/'.'map-marker_red.png');
    if ( $im_red==NULL )
    {
          echo "Cannot Initialize new GD image stream";
          die('Cannot Initialize new GD image stream');
    }
      
      // create a text colour
    $background = imagecolorallocate( $im_red, 255, 0, 0 );
    $text_color = imagecolorallocate($im_red, 255, 255, 255 );
      
      // write some text into the image
    //imagestring($im, 6,10, 10, 'CHF '.intVal($property_data['price_per_night']), $text_color);

    imagestring($im_red, 6,15, 15, 'CHF', $text_color);

    $x =     ceil(log10(intVal($property_data['price_per_night'])));
   
    if($property_data['price_per_night'] == 10)
    $x = 2;
    if($property_data['price_per_night'] == 100)
    $x = 3;
    if($property_data['price_per_night'] == 1000)
    $x = 4;
    if($property_data['price_per_night'] == 10000)
    $x = 5;  
    
    if($x == 1)
    imagestring($im_red, 6,25, 30, intVal($property_data['price_per_night']), $text_color);
    if($x == 2)
    imagestring($im_red, 6,20, 30, intVal($property_data['price_per_night']), $text_color);
    if($x == 3)
    imagestring($im_red, 6,15, 30, intVal($property_data['price_per_night']), $text_color);
    if($x == 4)
    imagestring($im_red, 6,10, 30, intVal($property_data['price_per_night']), $text_color);
    if($x == 5)
    imagestring($im_red, 6,5, 30, intVal($property_data['price_per_night']), $text_color);   
      
      
      //save the image to disk
    $path = public_path('product/');
    $path_red = public_path('product_red/');
    $unqiue_path = date('YmdHis').'product.png';
    imagesavealpha($im, true);
    $color = imagecolorallocatealpha($im, 0, 0, 0, 127);
    imagefill($im, 0, 0, $color);
    imagepng($im,  $path.$unqiue_path);
    $this->property->where('id', $property_id)->update(['icon_path' => $unqiue_path]);

    imagesavealpha($im_red, true);
    $color = imagecolorallocatealpha($im_red, 0, 0, 0, 127);
    imagefill($im_red, 0, 0, $color);
    imagepng($im_red,  $path_red.$unqiue_path);
    $this->property->where('id', $property_id)->update(['icon_path' => $unqiue_path]);
      
      // we dont need the image anymore
    imagedestroy($im);
       
     $property_data['checkboxvar'] = Input::get('checkboxvar');
    foreach( $property_data['checkboxvar'] as $key=>$val)
    {
      $feature = ['feature_id' => $val, 'property_id' => $property_id];
      $this->feature->create($feature);
    }
    $image = ['property_id' => $property_id];
    $this->image_model->where('session_id', $property_data['_token'])->update($image);
    }
    return redirect('listing')->with('message','New Ads Created Successfully')->with('color','green');
    
    
  }


  public function editHostBankAccount()
  {
      
      
      $bank_edit_data['name'] = Input::get('name');
      $bank_edit_data['iban'] = Input::get('iban');
      $bank_edit_data['bic'] = Input::get('bic');
      $bank_edit_data['blz'] = Input::get('blz');
      $bank_edit_data['vat_nr'] = Input::get('vat_nr');
      $bank_edit_data['vat_number'] = Input::get('vat_number');
      if(count($this->account->where('user_id', Auth::user()->id)->get()))
      {
       $this->account->where('user_id',Auth::user()->id)->update($bank_edit_data);
      }
      else
      {
        $bank_edit_data['user_id'] = Auth::user()->id; 
        $bank_edit_data['created_at'] = date('Y-m-d H:i:s');
        $this->account->create($bank_edit_data);
      }

      return back()->with('message','Bank Detail Updated Successfully')->with('color','green');
      die;
  } 

  public function deleteUserImage()
    {
      if(Auth::user()->user_type == 1)
      {
        $data['path'] = "";
        $this->user->where('id',Auth::user()->id)->update($data);
        return back()->with('message','Image Deleted Successfully')->with('color','red');
      }

      if(Auth::user()->user_type == 0 || Auth::user()->user_type == 2) 
      {
        $data['path'] = "";
        $this->user->where('id',Auth::user()->id)->update($data);
        return back()->with('message','Image Deleted Successfully')->with('color','red');
      }
    }

    public function editHost(Request $request)
    {
      
      if(Auth::user()->user_type == 1)
      {
          
          if(Input::file())
          {
  
            $image = Input::file('profile_pic');
            $filename  = Input::get('name').time() . '.' . $image->getClientOriginalExtension();

            $path = public_path('profilepics/' . $filename);

            Image::make($image->getRealPath())->resize(200, 200)->save($path);
            //$data['id'] = Auth::user()-id;
            $data['path'] = $filename;
            $this->user->where('id',Auth::user()->id)->update($data);
          }
        

          $user_edit_data['company'] = Input::get('company');
          $user_edit_data['saluation'] = Input::get('saluation');
          $user_edit_data['name'] = Input::get('name');
          $user_edit_data['surname'] = Input::get('surname');
          $user_edit_data['address'] = Input::get('address');
          $user_edit_data['additional_address'] = Input::get('additional_address');
          $user_edit_data['place'] = Input::get('place');
          $user_edit_data['city'] = Input::get('city');
          $user_edit_data['zipcode'] = Input::get('zipcode');
          $user_edit_data['country_id'] = Input::get('country');
          $user_edit_data['phone'] = substr(Input::get('phone'),3);
          $user_edit_data['email'] = Input::get('email');


          if(empty(Input::get('password')))
          {
            $this->user->where('id',Auth::user()->id)->update($user_edit_data);
            return back()->with('message','Your Profile Updated Successfully')->with('color','green');
          }else
          {
            if(Input::get('password') == Input::get('cpassword'))
            {
              $user_edit_data['password'] = bcrypt(Input::get('password'));
              $this->user->where('id',Auth::user()->id)->update($user_edit_data);
            return back()->with('message','Your Profile Updated Successfully, Your Password Updated Successfully')->with('color','green');
            }
          }
           
      }else if(Auth::user()->user_type == 0)
      {
          if(Input::file())
          {
  
            $image = Input::file('profile_pic');
            $filename  = Input::get('name').time() . '.' . $image->getClientOriginalExtension();

            $path = public_path('profilepics/' . $filename);

            Image::make($image->getRealPath())->resize(200, 200)->save($path);
            //$data['id'] = Auth::user()-id;
            $data['path'] = $filename;
            $this->user->where('id',Auth::user()->id)->update($data);
          }
        

          $user_edit_data['company'] = Input::get('company');
          $user_edit_data['saluation'] = Input::get('saluation');
          $user_edit_data['name'] = Input::get('name');
          $user_edit_data['surname'] = Input::get('surname');
          $user_edit_data['address'] = Input::get('address');
          $user_edit_data['additional_address'] = Input::get('additional_address');
          $user_edit_data['place'] = Input::get('place');
          $user_edit_data['city'] = Input::get('city');
          $user_edit_data['zipcode'] = Input::get('zipcode');
          $user_edit_data['country_id'] = Input::get('country');
          $user_edit_data['phone'] = substr(Input::get('phone'),3);
          $user_edit_data['email'] = Input::get('email');


          if(empty(Input::get('password')))
          {
            $this->user->where('id',Auth::user()->id)->update($user_edit_data);
            return back()->with('message','Your Profile Updated Successfully')->with('color','green');
          }else
          {
            if(Input::get('password') == Input::get('cpassword'))
            {
              $user_edit_data['password'] = bcrypt(Input::get('password'));
              $this->user->where('id',Auth::user()->id)->update($user_edit_data);
            return back()->with('message','Your Profile Updated Successfully, Your Password Updated Successfully')->with('color','green');
            }
          }
      }
      
    }


    /*Booking Acceptance and Mail Shootout to Admin/Tenat
    */
    public function accept($id)
    { 
      
      if(Auth::check())
      {
       $user_id = Auth::user()->id; 
       $host_name = Auth::user()->name;  
      }
      $this->property->where('id', $id)->update(['property_booking_status' => 1]);
      $booking_id = $this->property->where('id', $id)->pluck('booking_id');
      $booking = $this->payment->where('id',$booking_id[0])->pluck('user_id');
      $tenant = $this->user->where('id', $booking[0])->get();
      $this->billingInfo->where('booking_id', $booking_id[0])->update(['booking_status_host' => 1]);
      
      $properties = $this->property->where('id', $id)->get();

      /*******************BOOKING PDF*********************/
      $invoice_number = date('dmYhis');
      $booking_number = $booking_id[0];
      $service_invoice_number = date('dmYhis') . $booking_number;
      $html = view('frontend.links.pdf-map', compact('properties', 'invoice_number', 'booking_number'))->render();
      $filename = date('dmYhis').'booking.pdf';
      $this->pdf->load($html)->filename('bookings/'.$filename)->output();
      $this->payment->where('id', $booking_id[0])->update(['booking_pdf' => $filename, 'invoice_number' => $invoice_number, 'service_invoice_number' => $service_invoice_number]);

      /*******************SERVICE FEE PDF*********************/
      $properties_count = count($this->property->where('user_id', Auth::user()->id)->where('booking_id', '!=', 0)->get());
      $html = view('frontend.links.pdf-service', compact('properties', 'properties_count', 'service_invoice_number', 'booking_number'))->render(); 
      $filename = date('dmYhis').'serviceFee.pdf'; 
//var_dump($html);
      $this->pdf1->load($html)->filename('service-fee/'.$filename)->output(); 
      
      $this->payment->where('id', $booking_id[0])->update(['service_fee_pdf' => $filename]);
      $get_pdf = $this->payment->where('id', $booking_id[0])->get();  
      
      $property_image = '';

      if (count($properties[0]->images) > 0) {
        $property_image = 'images/thumb/'.$properties[0]->images[0]->path;
      }

      $admin_mail_data = [
                  'company'    => $properties[0]->user->company,
                  'address'    => $properties[0]->user->address,
                  'place'    => $properties[0]->user->place,
                  'phone'    => $properties[0]->user->phone,
                  'host_image' =>  'profilepics/'.$properties[0]->user->path,
                  'host_name'  => $properties[0]->user->name.' '.$properties[0]->user->surname,
                  'created_at' => $properties[0]->user->created_at,
                  'property_image' => $property_image,
                  'property_id'=> $properties[0]->id,
                  'title'      => $properties[0]->title,
                  'street'     => $properties[0]->street,
                  'plz_place'  => $properties[0]->plz_place,
                  'check_in'   => date('Y-m-d', strtotime($properties[0]->booking->booking->check_in)),
                  'check_out'  => date('Y-m-d', strtotime($properties[0]->booking->booking->check_out)),
                  'price'      => $properties[0]->booking->amount,
                  'nights'     => $properties[0]->booking->booking->nights,
                  'initial'    => $properties[0]->booking->initial,
                  'remark'     => $properties[0]->booking->booking->remark,
                  'name'      => 'Satyendra Singh',
                  'email'     => 'satyendra.singh@hestabit.in',
                  'host_name' => $host_name,
                  'view'      => 'emails.after-accept-booking-host',
                  'subject'   => 'Booking Confirmed',
                  'attach'    => url('/').'/bookings/'.$get_pdf[0]->booking_pdf,

              ];  

      
      $tenant_mail_data = [
                  'company'    => $properties[0]->user->company,
                  'address'    => $properties[0]->user->address,
                  'place'    => $properties[0]->user->place,
                  'phone'    => $properties[0]->user->phone,
                  'host_image' =>  'profilepics/'.$properties[0]->user->path,
                  'host_name'  => $properties[0]->user->name.' '.$properties[0]->user->surname,
                  'created_at' => $properties[0]->user->created_at,
                  'property_image' => $property_image,
                  'property_id'=> $properties[0]->id,
                  'title'      => $properties[0]->title,
                  'street'     => $properties[0]->street,
                  'plz_place'  => $properties[0]->plz_place,
                  'check_in'   => date('Y-m-d', strtotime($properties[0]->booking->booking->check_in)),
                  'check_out'  => date('Y-m-d', strtotime($properties[0]->booking->booking->check_out)),
                  'price'      => $properties[0]->booking->amount,
                  'nights'     => $properties[0]->booking->booking->nights,
                  'initial'    => $properties[0]->booking->initial,
                  'remark'     => $properties[0]->booking->booking->remark,
                  'name'      => $tenant[0]->name,
                  'email'     => $tenant[0]->email,
                  'host_name' => $host_name,
                  'view'      => 'emails.after-accept-booking-host',
                  'subject'   => 'Booking Confirmed',
                  'attach'    => url('/').'/bookings/'.$get_pdf[0]->booking_pdf,

              ];  

      
      try 
      {
          
          $tenant_mail_data['link' ] = url('/') . '/single/' . $id;
          $tenant_mail_data['cancel' ] = url('/') . '/cancel/' . $id;
          $admin_mail_data['link' ] = url('/') . '/single/' . $id;
          $admin_mail_data['cancel' ] = url('/') . '/cancel/' . $id;

          $this->helper->send_mail($tenant_mail_data);
          $this->helper->send_mail($admin_mail_data);

          
      }catch (\Exception $e)
      {
                          dd($e);
                          
      }


     
      
      return redirect('/booking')->with('message','You have accepted booking successfully')->with('color','green'); 
    }


    public function reject($id)
    {
      
      $this->property->where('id', $id)->update(['property_booking_status' => 2]);
      $properties = $this->property->where('id', $id)->get();
      $this->billingInfo->where('booking_id', $properties[0]->booking_id)->update(['booking_status_host' => 2]);
      $booking = $this->payment->where('id',$properties[0]->booking_id)->pluck('user_id');
      $tenant = $this->user->where('id', $booking[0])->get();
      
     
      // $get_pdf = $this->payment->where('id', $properties[0]->booking_id)->get();  
      // $admin_mail_data = [
      //             'company'    => $properties[0]->user->company,
      //             'address'    => $properties[0]->user->address,
      //             'place'    => $properties[0]->user->place,
      //             'phone'    => $properties[0]->user->phone,
      //             'host_image' =>  'profilepics/'.$properties[0]->user->path,
      //             'host_name'  => $properties[0]->user->name.' '.$properties[0]->user->surname,
      //             'created_at' => $properties[0]->user->created_at,
      //             'property_image' => 'images/thumb/'.$properties[0]->images[0]->path,
      //             'property_id'=> $properties[0]->id,
      //             'title'      => $properties[0]->title,
      //             'street'     => $properties[0]->street,
      //             'plz_place'  => $properties[0]->plz_place,
      //             'check_in'   => date('Y-m-d', strtotime($properties[0]->booking->booking->check_in)),
      //             'check_out'  => date('Y-m-d', strtotime($properties[0]->booking->booking->check_out)),
      //             'price'      => $properties[0]->booking->amount,
      //             'nights'     => $properties[0]->booking->booking->nights,
      //             'initial'    => $properties[0]->booking->initial,
      //             'remark'     => $properties[0]->booking->booking->remark,
      //             'name'      => 'Satyendra',
      //             'email'     => 'satyendra.singh@hestabit.in',
      //             'host_name' =>  $properties[0]->user->name,
      //             'view'      => 'emails.after-cancel-booking-host',
      //             'subject'   => 'Booking Canceled',
      //             'attach'    =>  url('/').'/bookings/'.$get_pdf[0]->booking_pdf,

      //         ];  

      
      // $tenant_mail_data = [
      //             'company'    => $properties[0]->user->company,
      //             'address'    => $properties[0]->user->address,
      //             'place'    => $properties[0]->user->place,
      //             'phone'    => $properties[0]->user->phone,
      //             'host_image' =>  'profilepics/'.$properties[0]->user->path,
      //             'host_name'  => $properties[0]->user->name.' '.$properties[0]->user->surname,
      //             'created_at' => $properties[0]->user->created_at,
      //             'property_image' => 'images/thumb/'.$properties[0]->images[0]->path,
      //             'property_id'=> $properties[0]->id,
      //             'title'      => $properties[0]->title,
      //             'street'     => $properties[0]->street,
      //             'plz_place'  => $properties[0]->plz_place,
      //             'check_in'   => date('Y-m-d', strtotime($properties[0]->booking->booking->check_in)),
      //             'check_out'  => date('Y-m-d', strtotime($properties[0]->booking->booking->check_out)),
      //             'price'      => $properties[0]->booking->amount,
      //             'nights'     => $properties[0]->booking->booking->nights,
      //             'initial'    => $properties[0]->booking->initial,
      //             'remark'     => $properties[0]->booking->booking->remark,
      //             'name'      => $tenant[0]->name,
      //             'email'     => $tenant[0]->email,
      //             'host_name' => $properties[0]->user->name,
      //             'view'      => 'emails.after-cancel-booking-host',
      //             'subject'   => 'Booking Canceled',
      //             'attach'    => url('/').'/bookings/'.$get_pdf[0]->booking_pdf,

      //         ];  

      
      // try 
      // {
          
      //     $tenant_mail_data['link' ] = url('/') . '/single/' . $id;
      //     $tenant_mail_data['cancel' ] = url('/') . '/cancel/' . $id;
      //     $admin_mail_data['link' ] = url('/') . '/single/' . $id;
      //     $admin_mail_data['cancel' ] = url('/') . '/cancel/' . $id;

      //     $this->helper->send_mail($tenant_mail_data);
      //     $this->helper->send_mail($admin_mail_data);
          
          
      // }catch (\Exception $e)
      // {
      //                     //dd($e);
                          
      // }
      return  Response::json(array('confirm'=>'BOOKING CANCELED!', 'message' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You have cacelled booking successfully.', 'status' => 1));
            die;
     

  }


  public function cancel($id)
  {

    $properties = $this->property->where('id', $id)->get();
    $billing    = $this->billingInfo->where('booking_id', $properties[0]->booking_id)->get()->toArray();
    
    $created = new \Carbon\Carbon($billing[0]['created_at']);
    $now = \Carbon\Carbon::now();
    $difference = $created->diff($now)->days + 1;
    
    if($difference <= $properties[0]->cancel_day && !($created >= $now))
    {
      if(Auth::check() && Auth::user()->user_type == 0)
      {
        $this->property->where('id', $id)->update(['property_booking_status' => 2]);
        $this->billingInfo->where('booking_id', $properties[0]->booking_id)->update(['booking_status_tenant' => 2]);
        $properties = $this->property->where('id', $id)->get();
        $booking = $this->payment->where('id',$properties[0]->booking_id)->pluck('user_id');
        $tenant = $this->user->where('id', $booking[0])->get();
        
       
        $get_pdf = $this->payment->where('id', $properties[0]->booking_id)->get();  
        $admin_mail_data = [
                    'company'    => $tenant[0]->name." ".$tenant[0]->surname,
                    'address'    => $properties[0]->user->address,
                    'place'    => $properties[0]->user->place,
                    'phone'    => $properties[0]->user->phone,
                    'host_image' =>  'profilepics/'.$tenant[0]->path,
                    'host_name'  => $properties[0]->user->name.' '.$properties[0]->user->surname,
                    'created_at' => $tenant[0]->created_at,
                    'property_image' => 'images/thumb/'.$properties[0]->images[0]->path,
                    'property_id'=> $properties[0]->id,
                    'title'      => $properties[0]->title,
                    'street'     => $properties[0]->street,
                    'plz_place'  => $properties[0]->plz_place,
                    'check_in'   => date('Y-m-d', strtotime($properties[0]->booking->booking->check_in)),
                    'check_out'  => date('Y-m-d', strtotime($properties[0]->booking->booking->check_out)),
                    'price'      => $properties[0]->booking->amount,
                    'nights'     => $properties[0]->booking->booking->nights,
                    'initial'    => $properties[0]->booking->initial,
                    'remark'     => $properties[0]->booking->booking->remark,
                    'name'       => $properties[0]->user->name,
                    'email'      => $properties[0]->user->email,
                    'host_name'  =>  $properties[0]->user->name,
                    'view'       => 'emails.after-cancel-booking-host',
                    'subject'    => 'Booking Canceled',
                    'attach'     =>  url('/').'/bookings/'.$get_pdf[0]->booking_pdf,

                ];  

        
        $tenant_mail_data = [
                    'company'    => $tenant[0]->name." ".$tenant[0]->surname,
                    'address'    => $properties[0]->user->address,
                    'place'    => $properties[0]->user->place,
                    'phone'    => $properties[0]->user->phone,
                    'host_image' =>  'profilepics/'.$tenant[0]->path,
                    'host_name'  => $properties[0]->user->name.' '.$properties[0]->user->surname,
                    'created_at' => $tenant[0]->created_at,
                    'property_image' => 'images/thumb/'.$properties[0]->images[0]->path,
                    'property_id'=> $properties[0]->id,
                    'title'      => $properties[0]->title,
                    'street'     => $properties[0]->street,
                    'plz_place'  => $properties[0]->plz_place,
                    'check_in'   => date('Y-m-d', strtotime($properties[0]->booking->booking->check_in)),
                    'check_out'  => date('Y-m-d', strtotime($properties[0]->booking->booking->check_out)),
                    'price'      => $properties[0]->booking->amount,
                    'nights'     => $properties[0]->booking->booking->nights,
                    'initial'    => $properties[0]->booking->initial,
                    'remark'     => $properties[0]->booking->booking->remark,
                    'name'      => $tenant[0]->name,
                    'email'     => $tenant[0]->email,
                    'host_name' => $properties[0]->user->name,
                    'view'      => 'emails.after-cancel-booking-host',
                    'subject'   => 'Booking Canceled',
                    'attach'    => url('/').'/bookings/'.$get_pdf[0]->booking_pdf,

                ];  

        
        try 
        {
            
            $tenant_mail_data['link' ] = url('/') . '/single/' . $id;
            $tenant_mail_data['cancel' ] = url('/') . '/cancel/' . $id;
            $admin_mail_data['link' ] = url('/') . '/single/' . $id;
            $admin_mail_data['cancel' ] = url('/') . '/cancel/' . $id;

            //$this->helper->send_mail($tenant_mail_data);
            $this->helper->send_mail($admin_mail_data);
            return  Response::json(array('confirm'=>'BOOKING CANCELED!', 'message' => '   Your booking has canceled. Your paid deposit will be refunded within 24 hours.', 'status' => 1));
            die;
            
        }catch (\Exception $e)
        {
                            //dd($e);
                            
        }

      }
      
      
    }else {
      return  Response::json(array('confirm'=>'CANCELING FAILED!', 'message' => '   You can not cancel booking before '.$properties[0]->cancel_day.' days booking date.', 'status' => 0));
      die;

    }
  }

  public function sendMessage()
  {
    $data['property_id'] = Input::get('property_id');
    $data['booking_id']  = Input::get('booking_id');
    $data['owner_id']    = Input::get('owner_id');
    $data['message']     = Input::get('message');
    $data['is_read']     = 0;
    $this->message->create($data);
    return  Response::json(array('confirm'=>'Message Sent.', 'message' => '   Your message submitted successfully', 'status' => 1));
      die;
  }

  public function getMessage()
  {
    //$data['property_id'] = Input::get('property_id');
    //$data['booking_id']  = Input::get('booking_id');
    $count =0;
    $name  ="";
    $payments_user = $this->payment->where('id', Input::get('booking_id'))->get();

    if(Auth::check() && Auth::user()->user_type == 1) {
    $name  = $payments_user[0]->user->name." ".$payments_user[0]->user->surname;
    $count = $this->message->where('owner_id', $payments_user[0]->user_id)->where('property_id', Input::get('property_id'))->where('booking_id', Input::get('booking_id'))->where('is_read', 0)->count();
    $this->message->where('owner_id', $payments_user[0]->user_id)->where('property_id', Input::get('property_id'))->where('booking_id', Input::get('booking_id'))->update(['is_read'=> 1]);
    }else {
    $name  = $payments_user[0]->host->name." ".$payments_user[0]->host->surname;  
    $count = $this->message->where('owner_id', $payments_user[0]->host_id)->where('property_id', Input::get('property_id'))->where('booking_id', Input::get('booking_id'))->where('is_read', 0)->count();
    $this->message->where('owner_id', $payments_user[0]->host_id)->where('property_id', Input::get('property_id'))->where('booking_id', Input::get('booking_id'))->update(['is_read'=> 1]);  
    }
    $data = $this->message->where('property_id', Input::get('property_id'))->where('booking_id', Input::get('booking_id'))->get();
    
    $final_data = array();
    foreach($data as $key=>$val)
    {
      //print_r($val->user);
      $data1[$key]['message']= $val['message'];
      $data1[$key]['created']= Carbon::createFromTimeStamp(strtotime($val['created_at']))->diffForHumans();
      $data1[$key]['name']   = $val->user['name']." ".$val->user['surname'];
      $data1[$key]['path']   = $val->user['path'];
      $data1[$key]['id'] = $val->user['id'];
      //print_r($val->user['id']);
    }
    $final_data['data']= $data1;
    $final_data['name'] = $name;
    $final_data['count']= $count;
      
    return  Response::json($final_data);
      die;
  }



}
