<?php

require_once "include/utils.php";

function book_zoo_visit($username, $start_datetime, $end_datetime, $number_of_people, $educational_visit, $pdo) {
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
                        <button type="submit" class="btn btn-success float-end" id="book_ticket" name="book_ticket">Reserve a ticket</>
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
                        <div class="mb-3 col-md-8">
                            <label for="month" class="form-label">Select a month:</label>
                            <input type="month" class="form-control" id="month" name="month" required
                            onchange="get_booked_days(this.value, function(data) {
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