<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AirlineModel\Flight;
use App\AirlineModel\Airline;
use App\AirlineModel\Booking;
use App\AirlineModel\FlightSeat;
use App\AirlineModel\Passenger;
use App\AirlineModel\SeatClass;
use Session;


class FlightController extends Controller
{	
	// public function __construct(SeatClass $seat_class)
	// {
	// 	$this->seat_class = $seat_class;
	// }
	public function storeAirline(Request $request)
	{
		$this->validate($request, array(
			'airline_name' => 'required|max:100',
			'city' => 'required|max:100'
		));

		$airline = new Airline([
			'airline_name' => $request->airline_name,
			'city' => $request->airline_name
		]);

		$airline->save();

		$message = "Airline has been created!";
		return response()->json($message, 201);
	}
	public function storeFlight(Request $request)
	{
		$flight_code = substr(Airline::where('airline_id',$request->airline_id)->first()->city,0,3);
		// dd($flight_code);
		$flight = array(
			'flight_code' => $flight_code,
			'airline_id' => $request->airline_id,
			'depart_time' => formatTime($request->depart_time),
			'depart_date' => formatDate($request->depart_date),
			'arrival_time' => formatTime($request->arrival_time),
			'arrival_date' => formatDate($request->arrival_date),
			'depart_city' => $request->depart_city,
			'destination_city' => $request->destination_city
		);

		$flight_id = Flight::insertGetId($flight);

		$response = [
			'Flight ID' => $flight_id,
			'flight_data' => $flight
		];
		return response()->json($response, 201);
	}
	public function searchFlight(Request $request)
	{	

		$seat_class = SeatClass::where('seat_class_id',3)->first();

		///One Way 
		$response['oneway'] = $seat_class->flight()
		->where("depart_date",formatDate($request->depart_date))
		->where("depart_city","like","%$request->depart_city%")
		->where("destination_city","like","%$request->destination_city%")
		->get();

		//If Chose Round Trip
		if($request->round_trip == true){
			$response['return'] = $seat_class->flight()
			->where("depart_date",formatDate($request->return_date))
			->Where("depart_city","like","%$request->destination_city%")
			->Where("destination_city","like","%$request->depart_city%")
			->get();
		}

		Session::put('searching', $response);
		// dd(Session::get('searching'));
		return response()->json($response,200);
	}

	public function bookingFlight(Request $request)
	{
		if(Session::get('searching'))
		{	
			Session::forget('searching');
			return "haha";
		}

	}


}
