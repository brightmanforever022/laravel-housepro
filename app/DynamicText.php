<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DynamicText extends Model
{
    //
    protected $fillable = ['title', 'description','logo', 'rows', 'type'];
}
