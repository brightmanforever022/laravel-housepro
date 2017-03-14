<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingInfo extends Model
{
    protected $table = 'billinginfos';
	protected $fillable = [
		'check_in',
		'check_out',
		'nights',
		'guests',
		'saluation',
		'name',
		'surname',
		'phone',
		'email',
		'remark',
		'booking_id',
		'booking_status_tenant'	
		
	];

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function payment()
    {
        return $this->belongsTo('App\Payment','booking_id');
    }
}