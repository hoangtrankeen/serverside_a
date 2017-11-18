<?php

namespace App\AirlineModel;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    //
    protected $primaryKey = 'flight_id';

    protected $table = 'flight';

    // protected $fillable = ['flight_code'];

    public $timestamps = false;

    protected $guarded = [];

    public function seat_class()
    {
    	return $this->belongsToMany('App\AirlineModel\SeatClass','flight_seat','flight_id','seat_class_id')->withPivot('total_seats','remain_seats');
    }
}
