<?php 

function formatDate($request_date)
{
	return date("Y-m-d",strtotime($request_date));
}
function formatTime($request_time)
{
	return date("H:i:s",strtotime($request_time));
}

?>