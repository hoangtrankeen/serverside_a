<?php

namespace App\AirlineModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeatClass extends Model
{
    //
	protected $primaryKey = 'seat_class_id';

	protected $table = 'seat_class';

	protected $guarded = [];

	public $timestamps = false;

	public function flight()
	{
		return $this->belongsToMany('App\AirlineModel\Flight','flight_seat','seat_class_id','flight_id')->withPivot('total_seats','remain_seats');
	}


}
