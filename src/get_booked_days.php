<?php

require_once "include/connect.php";

const MAX_VISITORS = 100;

// Get the days that are fully booked up for a certain number of people in a specific month
function get_booked_days($month_and_year, $number_of_people, $pdo) {
    $month = date("m", $month_and_year);
    $year = date("Y", $month_and_year);

    // Get sum of all 
    $first_day_of_month = date("Y-m-d 00:00:00", $month_and_year);

    $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $last_day_of_month = date("Y-m-d 23:59:59", $month_and_year);
    // Substract 1 day from the days of the month because it will start on day 1, not day 0
    $last_day_of_month = date_modify(date_create($first_day_of_month), "+" . ($days_in_month) - 1 . " day")->format("Y-m-d H:i:s");

    // "BETWEEN :first_day_of_month and :last_day_of_month" just means in that month
    $get_bookings_intersecting_month = $pdo->prepare(
        "SELECT
            zoo_bookings_daily.day, SUM(zoo_bookings.number_of_people) as total_visitors
        FROM zoo_bookings_daily
        JOIN zoo_bookings
        ON zoo_bookings.zoo_booking_id = zoo_bookings_daily.zoo_booking_id
        WHERE (
            (zoo_bookings.end_datetime BETWEEN :first_day_of_month AND :last_day_of_month)
            OR
            (zoo_bookings.start_datetime BETWEEN :first_day_of_month AND :last_day_of_month)
        )
        GROUP BY zoo_bookings_daily.day"
    );
    $get_bookings_intersecting_month->execute([
        "first_day_of_month" => $first_day_of_month,
        "last_day_of_month" => $last_day_of_month
    ]);
    $bookings_intersecting_month = $get_bookings_intersecting_month->fetchAll();

    return json_encode($bookings_intersecting_month);
}

$month_and_year = $_REQUEST["month"] ?? FALSE;
if (! $month_and_year) {
    die();
}

$month_and_year_value = strtotime($month_and_year);
echo "<pre>";
print_r(get_booked_days($month_and_year_value, 4, $pdo));
echo "</pre>";