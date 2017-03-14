<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyDate extends Model
{
    protected $fillable = [
        'property_id',
        'selected_date'
    ];

    public function property()
    {
    	return $this->belongsTo('App\Property');
    }
}
