<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = ['property_id', 'booking_id','owner_id', 'message', 'is_read'];

    
    public function user()
    {
        return $this->belongsTo('App\User', 'owner_id');
    }

    
}
