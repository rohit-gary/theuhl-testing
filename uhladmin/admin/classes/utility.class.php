<?php
class Utility
{
	public function get_month_from_date($date_str)
	{
		// Convert the date string to a DateTime object
	    $date_obj = DateTime::createFromFormat('Y-m-d', $date_str);
	    // Extract the month from the DateTime object
	    $month = $date_obj->format('F');
	    return $month;
	}
}
