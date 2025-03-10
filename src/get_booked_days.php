<?php

require_once "include/utils.php";

// Get the days that are fully booked up for a certain number of people in a specific month
function get_booked_days($month_and_year, $potential_visitors, $max_visitors, $pdo) {
    $fetch = new Fetch();

    try {
        $month = date("m", $month_and_year);
        $year = date("Y", $month_and_year);

        // Get sum of all 
        $first_day_of_month = date("Y-m-d 00:00:00", $month_and_year);

        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $last_day_of_month = date("Y-m-d 23:59:59", $month_and_year);
        // Substract 1 day from the days of the month because it will start on day 1, not day 0
        $last_day_of_month = date_modify(date_create($first_day_of_month), "+" . $days_in_month - 1 . " day")->format("Y-m-d H:i:s");

        // "BETWEEN :first_day_of_month and :last_day_of_month" just means in that month
        $get_days_booked_up = $pdo->prepare(
            "SELECT
                DAY(zoo_bookings_daily.day) AS day, SUM(zoo_bookings.number_of_people) AS total_visitors
            FROM zoo_bookings_daily
            JOIN zoo_bookings
            ON zoo_bookings.zoo_booking_id = zoo_bookings_daily.zoo_booking_id
            WHERE (zoo_bookings_daily.day BETWEEN :first_day_of_month AND :last_day_of_month)
            GROUP BY zoo_bookings_daily.day
            HAVING SUM(zoo_bookings.number_of_people) >= (:max_visitors - :potential_visitors)"
        );
        $get_days_booked_up->execute([
            "first_day_of_month" => $first_day_of_month,
            "last_day_of_month" => $last_day_of_month,
            "max_visitors" => $max_visitors,
            "potential_visitors" => $potential_visitors
        ]);
        $days_booked_up = $get_days_booked_up->fetchAll(PDO::FETCH_KEY_PAIR); // Needed to make the day number the index

        // Prepare data in an acceptable format for parsing on the client
        $days_booked_up_json = [];
        if ($potential_visitors > $max_visitors) {
            for ($day_index = 1; $day_index <= $days_in_month; $day_index++) {
                $days_booked_up_json[$day_index] = TRUE;
            }
        } else {
            for ($day_index = 1; $day_index <= $days_in_month; $day_index++) {
                $days_booked_up_json[$day_index] = isset($day_index, $days_booked_up[$day_index]) ? TRUE : FALSE;
            }
        }

        $fetch->result = json_encode($days_booked_up_json);
    } catch (Exception $e) {
            $fetch->error = $e;
    }

    return $fetch;
}

$month_and_year = $_REQUEST["month"] ?? FALSE;
$potential_visitors = $_REQUEST["potential_visitors"] ?? FALSE;
if (! $month_and_year) {
    echo "Please pick a month";
    die();
} elseif (! $potential_visitors) {
    $potential_visitors = 1;
}

$month_and_year_value = strtotime($month_and_year);
$booked_days = get_booked_days($month_and_year_value, $potential_visitors, MAX_ZOO_VISITORS, $pdo);
if (isset($booked_days->error)) {
    echo "Error getting JSON - $booked_days->error";
    die();
}

echo $booked_days->result;
die();