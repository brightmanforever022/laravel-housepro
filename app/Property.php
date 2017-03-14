<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    protected $fillable = [
        'plz_place', 'street', 'lat', 'lng', 'country_id', 'bedroom', 'bathroom', 'bed','apartment_for', 'lining_space', 'property_type_id', 'reference', 'price_per_night', 'price_per_week', 'cleaning_fee','start_date', 'end_date', 'min_stay', 'cancel_day', 'vat_number', 'cancel_fee', 'title','description','ical_path','user_id'
    ];

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function ical()
    {
        return $this->hasMany('App\Ical');
    }

    public function event()
    {
        return $this->hasMany('App\Event');
    }

    public function features()
    {
        return $this->hasMany('App\PropertyFeature');
    }

    public function tokens()
    {
        return $this->hasMany('App\Token');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function booking()
    {
        return $this->belongsTo('App\Payment','booking_id');
    }

    public function propertyDate()
    {
        return $this->hasMany('App\PropertyDate');
    }
    
}
