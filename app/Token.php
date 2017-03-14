<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['session_id', 'property_id'];

    public function property()
    {
        return $this->belongsTo('App\Property');
    }
}
