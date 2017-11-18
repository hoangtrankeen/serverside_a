<?php

namespace App\AirlineModel;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    //
    protected $table = 'airline';

    protected $guarded = [];

    public $timestamps = false;
}
