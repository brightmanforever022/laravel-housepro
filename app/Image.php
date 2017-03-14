<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['path', 'session_id', 'property_id'];

    public function property()
    {
        return $this->belongsTo('App\Property');
    }
}
