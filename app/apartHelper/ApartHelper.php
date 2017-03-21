<?php

use App\Property;
use App\PropertyFeature;
use App\PropertyDate;

class ApartHelper
{

    public function send_mail ($data) {
        Mail::send($data['view'], $data, function($message) use ($data)
        {
            $message->to($data['email'], $data['name'])->subject($data['subject']);
        });
    }

    protected function google_api($address)
    {
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

    public static function apartolino_round($x){
         $b = 0;
         $a = explode('.', $x);
         if(!isset($a[1])){
         return number_format(floatval($x/10), 2, '.', ''); ;   
         }else if($a[1] < 5){ 
          $b = number_format(floatval(($a[0].'0')/100), 2, '.', ''); 
          return $b; 
         }else if($a[1] == 5){
          $b = number_format(floatval(($a[0].'5')/100), 2, '.', ''); 
          return $b; 
         }else if($a[1] > 5){ 
          $b = number_format(floatval((($a[0]+1).'0')/100), 2, '.', '');
          return $b; 
         }
         
   }

   /**
    * Gets in between dates.
    *
    * @param      <type>  $startDate  The start date
    * @param      <type>  $endDate    The end date
    *
    * @return     array   In between dates.
    */
   public function getInBetweenDates($startDate, $endDate) {
        try {
            $begin = new DateTime($startDate);
            $end = new DateTime($endDate);
            $result = [];

            $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);

            foreach ($daterange as $date) {
                $result[] = $date->format("Y-m-d");
            }
            return $result;
        } catch (\Exception $e) {
            dd($e);
        }
   }

   /**
    * Gets the properties by date.
    *
    * @param      array   $porperties       The porperties
    * @param      <type>  $start_date       The start date
    * @param      <type>  $end_date_search  The end date search
    *
    * @return     array   The properties by date.
    */
   public function getPropertiesByDate($porperties, $start_date, $end_date_search) {
        try {
            $flag_start_date = false;
            $flag_end_date = false;
            $flag_all_date = false;
            $getInBetweenDates = [];
        
            foreach ($porperties as $property) {
                $property_dates = PropertyDate::where('property_id', $property->id)->get();
                if (count($property_dates) > 0) {
                    foreach ($property_dates as $date) {
                        if ($start_date == $date->selected_date) {
                            $flag_start_date = true;
                        }
                    }

                    foreach ($property_dates as $date) {
                        if ($flag_start_date) {
                            if ($end_date_search == $date->selected_date) {
                                $flag_end_date = true;
                                $getInBetweenDates = $this->getInBetweenDates($start_date, $end_date_search);
                            }
                        }
                    }

                    foreach ($property_dates as $date) {
                        if (count($getInBetweenDates) > 0) {
                            if (in_array($date->selected_date, $getInBetweenDates)) {
                                $flag_all_date = true;
                            }
                        }
                    }
                    if (!$flag_all_date) {
                        // $porperties = [];
                        return false;
                    }
                }
            }
            // return $porperties;
            return true;
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
    * Gets the properties by date.
    *
    * @param      array   $properties       The properties
    * @param      array   $more_search      More Search Options of Features by more search modal. For example [1,4,7,8]
    *
    * @return     array   The properties by feature.
    */
    public function getPropertiesByFeature($properties, $more_search){

        $result = array();
        if(count($more_search) > 0){
            foreach ($properties as $property) {
                $property_features = PropertyFeature::where('property_id', $property->id)->get();
                $property_features_list = array();
                foreach ($property_features as $property_feature) {
                    array_push($property_features_list, $property_feature->feature_id);
                }
                if(count(array_intersect($more_search, $property_features_list)) == count($more_search)){
                    array_push($result, $property);
                }
            }
        // print_r($more_search);exit;

            return $result;
        }else{
            return $properties;
        }

    }

    public function sortArrayByDate ($array)
    {
        try {

            uasort($array, function($a, $b){
                $format = 'd/m/Y'; 
                $ascending = true;
                $zone = new DateTimeZone('UTC');
                $d1 = DateTime::createFromFormat($format, $a, $zone)->getTimestamp();
                $d2 = DateTime::createFromFormat($format, $b, $zone)->getTimestamp();
                return $ascending ? ($d1 - $d2) : ($d2 - $d1);
            });

            return array_values($array);

        } catch (\Exception $e) {
            dd($e);
        }
    }
}
