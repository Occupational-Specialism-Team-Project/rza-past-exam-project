<?php

require_once "include/utils.php";

function validate_booking($username, $start_datetime, $end_datetime, $number_of_people, $educational_visit, $max_visitors, $max_ticket_duration, $pdo) {
    $fetch = new Fetch();
    $current_datetime = date("Y-m-d H:i:s");
    $booking_duration = strtotime($end_datetime) - strtotime($start_datetime);

    # We need to validate our inputs
    if (! isset($username, $start_datetime, $end_datetime, $number_of_people, $educational_visit, $max_visitors, $max_ticket_duration)) { // Presence Check
        $fetch->error = "You cannot have empty fields.";

        return $fetch;
    } elseif (! (strtotime($start_datetime) or strtotime($end_datetime))) { // Format Check
        $fetch->error = "Your start date or end date are in the wrong format.";

        return $fetch;
    } elseif ($number_of_people > $max_visitors) { // Length Check
        $fetch->error = "You cannot have a number of people ($number_of_people) greater than the max amount of visitors ($max_visitors).";

        return $fetch;
    } elseif ($start_datetime > $end_datetime) { // Consistency Check
        $fetch->error = "Start time ($start_datetime) cannot be later than end time ($end_datetime).";

        return $fetch;
    } elseif ($start_datetime < $current_datetime) { // Consistency Check
        $fetch->error = "Start time ($start_datetime) cannot be in the past ($current_datetime).";

        return $fetch;
    } elseif ($booking_duration > $max_ticket_duration) { // Length Check
        $fetch->error = "You cannot have a number of days between start date ($start_datetime) and end date ($end_datetime) that is greater than the max ticket duration ($max_ticket_duration).";

        return $fetch;
    }

    $conflicting_bookings = get_conflicting_bookings($number_of_people, $start_datetime, $end_datetime, $max_visitors, $pdo);
    if ($conflicting_bookings->result) { // Look Up Check
        $fetch->error = "You have conflicting bookings. Check the calendar for more information.";
        $fetch->result = $conflicting_bookings->result;

        return $fetch;
    } elseif (isset($conflicting_bookings->error)) {
        $fetch->error = $conflicting_bookings->error;
        $fetch->result = $conflicting_bookings->result;

        return $fetch;
    }

    $user = get_user_from_username($username, $pdo);
    if (isset($user->error)) {
        $fetch->error = $user->error;
        $fetch->result = $user->result;
    } elseif (! $user->result) { // Look Up Check
        $fetch->error = "You are not logged in as a valid user. User with the username $username does not exist.";
        $fetch->result = $user->result;
        return $fetch;
    }

    return $fetch;
}

function get_user_from_username($username, $pdo) {
    $fetch = new Fetch();

    try {
        $get_user_from_username = $pdo->prepare(
            "SELECT username FROM users WHERE username = :input_username"
        );
        $get_user_from_username->execute(["input_username" => $username]);
        $user = $get_user_from_username->fetchAll();
        $fetch->result = $user;
    } catch (Exception $e) {
        $fetch->error = $e;
    }

    return $fetch;
}

function get_conflicting_bookings($number_of_people, $start_datetime, $end_datetime, $max_visitors, $pdo) {
    $fetch = new Fetch();

    try {
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

        $conflicting_bookings = $get_conflicting_bookings->fetchAll();
        $fetch->result = $conflicting_bookings;
    } catch (Exception $e) {
        $fetch->error = $e;
    }

    return $fetch;
}

function book_zoo_visit($username, $start_datetime, $end_datetime, $number_of_people, $educational_visit, $max_visitors, $max_ticket_duration, $pdo) {
    $fetch = new Fetch();

    $valid_booking = validate_booking($username, $start_datetime, $end_datetime, $number_of_people, $educational_visit, $max_visitors, $max_ticket_duration, $pdo);
    if (isset($valid_booking->error)) {
        $fetch->error = $valid_booking->error;
        $fetch->result = $valid_booking->result;

        return $fetch;
    }

    try {
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
        $fetch->result = $booked_visit;
    } catch (Exception $e) {
        $fetch->error = $e;
    }

    return $fetch;
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
        MAX_TICKET_DURATION,
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
                            <input type="number" class="form-control" id="number_of_people" name="number_of_people" required min="1" max="<?=MAX_ZOO_VISITORS?>" value="1">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="educational_visit" class="form-label">Educational visit?</label>
                            <br>
                            <input type="checkbox" class="form-check-input" id="educational_visit" name="educational_visit">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <a href="tickets.php"><button type="button" class="btn btn-primary">See existing tickets</button></a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success float-end" id="book_ticket" name="book_ticket">Reserve a ticket</button>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <?php if (isset($zoo_visit)): ?>
                            <?php if ($zoo_visit->error): ?>
                                <div class="alert alert-danger" role="alert">
                                    Error - <?=$zoo_visit->error?>
                                </div>
                            <?php elseif (isset($zoo_visit->result)): ?>
                                <div class="alert alert-success" role="alert">
                                    Successfully booked zoo tickets. <a href="tickets.php">Navigate here</a> to see your tickets.
                                </div>
                            <?php endif ?>
                        <?php endif ?>
                    </div>
                </form>
            </div>
        </section>
        <section class="mx-auto col-md-5 mt-5">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Available Days</h1>
                </div>
                <form class="card-body container">
                    <h2 class="text-center mb-4">Here are days that are fully booked up:</h2>

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
                            <label for="potential_visitors" class="form-label">
                                <i>Visitors: (<b class="fst-normal" id="visitors_live_count"></b>)</i>
                            </label>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-1">
                                        <label class="form-label">0</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="range" class="form-range" id="potential_visitors" name="potential_visitors" min="0" max="<?=MAX_ZOO_VISITORS?>" value="0" required
                                        onchange="
                                            let visitors_text = document.getElementById('visitors_live_count');
                                            visitors_text.innerHTML = this.value;
                                            get_booked_days(document.getElementById('month').value, this.value, function(data) {
                                                createDays(data);
                                            });
                                        ">
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label"><?=MAX_ZOO_VISITORS?></label>
                                    </div>
                                </div>
                            </div>
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