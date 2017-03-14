<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['event_id', 'start_date', 'rec_type', 'end_date', 'title', 'event_pid', 'event_length','property_id'];

    public function property()
    {
        return $this->belongsTo('App\Property');
    }
}
