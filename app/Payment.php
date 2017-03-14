<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
   	protected $table = 'payments';

	protected $fillable = [
		'user_id',
		'host_id',
		'billing_id',
		'token',
		'status',
		'amount',
		'initial'
	];

	public function property()
    {
        return $this->hasOne('App\Property', 'booking_id');
    }

    public function booking()
    {
        return $this->hasOne('App\BillingInfo','booking_id');
    }

    public function user()
    {
        return  $this->belongsTo('App\User', 'user_id');
    }

    public function host()
    {
        return $this->belongsTo('App\User', 'host_id');
    }
}