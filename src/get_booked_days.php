<?php

const MAX_VISITORS = 100;

// Get the days that are fully booked up for a certain number of people in a specific month
function get_booked_days($month, $number_of_people, $pdo) {
    return;
}

$month_and_year = $_REQUEST["month"] ?? FALSE;
if (! $month_and_year) {
    die();
}

$month_and_year_value = strtotime($month_and_year);
$month = date("m", $month_and_year_value);
echo $month;
echo "<br>";
$year = date("Y", $month_and_year_value);
echo $year;
echo "<br>";
echo cal_days_in_month(CAL_GREGORIAN, $month, $year);

#echo get_booked_days($month, );