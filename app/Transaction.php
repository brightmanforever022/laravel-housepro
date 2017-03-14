<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
   	protected $table = 'transactions';

	protected $fillable = [
		'payKey',
		'paytime',
		'user_id',
		'status',
		'transactionId',
		'amount',
		'email',
		'booking_id',
	];

	public function property()
    {
        return $this->hasOne('App\Property');
    }

    public function booking()
    {
        return $this->hasOne('App\BillingInfo','booking_id');
    }
}