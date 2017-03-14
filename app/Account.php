<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //
    protected $fillable = [
        'name', 'iban', 'bic', 'blz', 'vat_nr', 'user_id'
    ];

    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
