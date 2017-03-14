<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyFeature extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['feature_id', 'property_id'];

    
}
