<?php

require_once "include/utils.php";

function get_conflicting_bookings($number_of_people, $start_datetime, $end_datetime, $max_visitors, $pdo) {
    $fetch = new Fetch();
    if ($number_of_people > $max_visitors) {
        $fetch->error = "You cannot have a number of people ($number_of_people) greater than the max amount of visitors ($max_visitors).";
        return $fetch;
    } elseif ($start_datetime > $end_datetime) {

    }
    $get_conflicting_bookings = $pdo->prepare(
        "SELECT zoo_booking_id FROM zoo_bookings
        WHERE (
            start_datetime BETWEEN :chosen_start_datetime AND :chosen_end_datetime
        ) OR (
            end_datetime BETWEEN :chosen_start_datetime AND :chosen_end_datetime
        ) OR (
            :chosen_start_datetime BETWEEN start_datetime AND end_datetime
        ) OR (
            :chosen_end_datetime BETWEEN start_datetime AND end_datetime
        )
        HAVING SUM(number_of_people) >= (:max_visitors - :chosen_number_of_people)"
    );
    $get_conflicting_bookings->execute([
        "chosen_start_datetime" => $start_datetime,
        "chosen_end_datetime" => $end_datetime,
        "chosen_number_of_people" => $number_of_people,
        "max_visitors" => $max_visitors
    ]);

    return $get_conflicting_bookings->fetchAll();
}

function book_zoo_visit($username, $start_datetime, $end_datetime, $number_of_people, $educational_visit, $max_visitors, $pdo) {
    $day_range = new DatePeriod(
        new DateTime($start_datetime),
        new DateInterval('P1D'),
        (new DateTime($end_datetime))->modify('+1 day')
    );
    
    $days = [];
    foreach ($day_range as $day) {
        $days[] = $day->format('Y-m-d');
    }

    $day_entries = [];
    foreach ($days as $day) {
        $day_entries[] = "(LAST_INSERT_ID(), '$day')";
    }

    $educational_visit  = $educational_visit ? 1 : 0;

    $book_zoo_visit = $pdo->prepare(
        "INSERT INTO zoo_bookings
            (username, start_datetime, end_datetime, number_of_people, educational_visit)
         VALUES
            (:username, :chosen_start_datetime, :chosen_end_datetime, :chosen_number_of_people, :chosen_educational_visit);
         INSERT INTO zoo_bookings_daily
            (zoo_booking_id, day)
         VALUES " . 
         implode(",", $day_entries)
    );
    $booked_visit = $book_zoo_visit->execute([
        "username" => $username,
        "chosen_start_datetime" => $start_datetime,
        "chosen_end_datetime" => $end_datetime,
        "chosen_number_of_people" => $number_of_people,
        "chosen_educational_visit" => $educational_visit
    ]);

    return $booked_visit;
}

$user = $_SESSION["user"];
$role = $_SESSION["role"];

# Validate user session and redirect if invalid
if (! (isset($user) and isset($role))) {
    redirect("login.php");
}
if ($_SESSION["role"] != "customer") {
    redirect("index.php");
}

if (isset($_POST["book_ticket"])) {
    $zoo_visit = book_zoo_visit(
        $user,
        $_POST["start_datetime"], $_POST["end_datetime"],
        $_POST["number_of_people"], $_POST["educational_visit"] ?? FALSE,
        MAX_ZOO_VISITORS,
        $pdo
    );
}

const PAGE_TITLE = "Zoo Booking";
include_once "include/base.php";

?>

<article class="container-fluid">
    <div class="row">
        <section class="mx-auto col-md-5 mt-5">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center"><?=PAGE_TITLE?></h1>
                </div>
                <form action="" method="POST" class="card-body container">
                    <h2 class="text-center mb-4">Feeling adventurous? Book a visit to our zoo:</h2>
                    
                    <div class="row mb-4">
                        <div class="mb-3 col-md-6">
                            <label for="start_datetime" class="form-label">Start date and time:</label>
                            <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="end_datetime" class="form-label">End date and time:</label>
                            <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="mb-3 col-md-8">
                            <label for="number_of_people" class="form-label">Number of people:</label>
                            <input type="number" class="form-control" id="number_of_people" name="number_of_people" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="educational_visit" class="form-label">Educational visit?</label>
                            <br>
                            <input type="checkbox" class="form-check-input" id="educational_visit" name="educational_visit">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <button type="submit" class="btn btn-success float-end" id="book_ticket" name="book_ticket">Reserve a ticket</button>
                    </div>
                    <div class="row mb-4">
                        <pre>
                            <?=print_r($zoo_visit)?>
                        </pre>
                    </div>
                </form>
            </div>
        </section>
        <section class="mx-auto col-md-5 mt-5">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center mb-4">Here are days that are fully booked up:</h1>
                </div>
                <form class="card-body container">
                    <div class="row mb-4">
                        <div class="mb-3 col-md-6">
                            <label for="month" class="form-label">Select a month:</label>
                            <input type="month" class="form-control" id="month" name="month" min="1" required
                            onchange="get_booked_days(this.value, document.getElementById('potential_visitors').value, function(data) {
                                createDays(data);
                            });">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="potential_visitors" class="form-label">How many people do you plan to bring with you?</label>
                            <input type="number" class="form-control" id="potential_visitors" name="potential_visitors" required
                            onchange="get_booked_days(document.getElementById('month').value, this.value, function(data) {
                                createDays(data);
                            });">
                        </div>
                    </div>

                    <div id="daysOfTheMonth" class="row mb-4 d-flex flex-row justify-content-start mx-auto gap-1">
                        <!-- This is where days of the month will be placed -->

                    </div>
                </form>
            </div>
        </section>
    </div>
</article>

<?php include_once "include/footer.php";