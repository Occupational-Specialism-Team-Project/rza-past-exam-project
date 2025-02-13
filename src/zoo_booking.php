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
        $fetch->error = "You cannot have a number of people ($number_of_people) greater than the maximum amount of visitors ($max_visitors).";

        return $fetch;
    } elseif ($number_of_people < 1) { // Length Check
        $fetch->error = "You cannot have a number of people ($number_of_people) less than the minimum amount of visitors (1).";

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

        while (TRUE) { // Keep generating booking keys until a unique one is generated
            $booking_key = random_int(0, 1000000000);
            $get_existing_keys = $pdo->prepare("SELECT booking_key FROM zoo_bookings WHERE booking_key = :generated_booking_key");
            $get_existing_keys->execute(["generated_booking_key" => $booking_key]);
            $existing_keys = $get_existing_keys->fetchAll();
            $fetch->result=$existing_keys;

            if (! $existing_keys) {
                break;
            }
        }

        $book_zoo_visit = $pdo->prepare(
            "INSERT INTO zoo_bookings
                (username, start_datetime, end_datetime, number_of_people, educational_visit, booking_key)
            VALUES
                (:username, :chosen_start_datetime, :chosen_end_datetime, :chosen_number_of_people, :chosen_educational_visit, :generated_booking_key);
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
            "chosen_educational_visit" => $educational_visit,
            "generated_booking_key" => $booking_key
        ]);
        $fetch->result = $booked_visit;
    } catch (Exception $e) {
        $fetch->error = $e;
    }

    return $fetch;
}

function verify_ticket($number_of_people, $booking_key, $pdo) {
    $fetch = new Fetch();
    $current_time = time();

    if (! $number_of_people) { // Presence Check
        $fetch->error = "You must present the number of visitors.";

        return $fetch;
    } elseif ($number_of_people <= 0) {
        $fetch->error = "You must present a positive integer that is not 0.";

        return $fetch;
    } elseif (! $booking_key) { // Presence Check
        $fetch->error = "You must present the booking key.";

        return $fetch;
    }

    try {
        $verify_ticket = $pdo->prepare(
            "SELECT zoo_booking_id, start_datetime, end_datetime, number_of_people, booking_key, active FROM zoo_bookings
            WHERE (booking_key = :booking_key)"
        );
        $verify_ticket->execute([
            "booking_key" => $booking_key
        ]);
        $ticket_verified = $verify_ticket->fetch();

        $fetch->result = $ticket_verified;
        if (! $ticket_verified) {
            $fetch->error = "A ticket with that booking key ($booking_key) does not exist.";

        } else if ($current_time < strtotime($ticket_verified["start_datetime"])) {
            $fetch->error = "The ticket is only valid from {$ticket_verified["start_datetime"]}";

            return $fetch;
        } else if ($current_time > strtotime($ticket_verified["end_datetime"])) {
            $fetch->error = "The ticket has expired (end date is {$ticket_verified["end_datetime"]}).";

            return $fetch;
        } else if ($number_of_people > $ticket_verified["number_of_people"]) {
            $fetch->error = "The ticket is only valid for a maximum of {$ticket_verified["number_of_people"]} people.";

            return $fetch;
        }

    } catch (Exception $e) {
        $fetch->error = $e;
    }

    return $fetch;
}

function activate_ticket($booking_id, $pdo) {
    $fetch = new Fetch();

    try {
        $activate_ticket = $pdo->prepare("UPDATE zoo_bookings SET active = 1 WHERE zoo_booking_id = :booking_id");
        $ticket_activated = $activate_ticket->execute(["booking_id" => $booking_id]);

        $fetch->result = $ticket_activated;
    } catch (Exception $e) {
        $fetch->error = $e;
    }

    return $fetch;
}

function deactivate_ticket($booking_id, $pdo) {
    $fetch = new Fetch();

    try {
        $deactivate_ticket = $pdo->prepare("UPDATE zoo_bookings SET active = 0 WHERE zoo_booking_id = :booking_id");
        $ticket_deactivated = $deactivate_ticket->execute(["booking_id" => $booking_id]);

        $fetch->result = $ticket_deactivated;
    } catch (Exception $e) {
        $fetch->error = $e;
    }

    return $fetch;
}

$user = $_SESSION["user"] ?? FALSE;
$role = $_SESSION["role"] ?? FALSE;
if (! $user) {
    redirect("login.php");
}
if ($role == "customer") {
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
} elseif ($role == "admin") {
    if (isset($_GET["verify_ticket"])) {
        $number_of_people = $_GET["number_of_people"] ?? FALSE;
        $booking_key = $_GET["booking_key"] ?? FALSE;
        $ticket_verified = verify_ticket(
            $number_of_people, $booking_key, $pdo
        );
    } elseif (isset($_GET["activate_ticket"])) {
        $booking_id  = $_GET["activate_ticket"] ?? FALSE;
        if ($booking_id) {
            $activated_ticket = activate_ticket($booking_id, $pdo);
        }
    } elseif (isset($_GET["deactivate_ticket"])) {
        $booking_id = $_GET["deactivate_ticket"] ?? FALSE;
        if ($booking_id) {
            $deactivated_ticket = deactivate_ticket($booking_id, $pdo);
        }
    }
}

const PAGE_TITLE = "Zoo Booking";
include_once "include/base.php";

?>

<article class="container-fluid">
    <div class="row">
        <?php if ($role == "customer"): ?>
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
                                <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime" required oninput="validateZooBooking()">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback" id="start_datetime_feedback">

                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="end_datetime" class="form-label">End date and time:</label>
                                <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime" required oninput="validateZooBooking()">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback" id="end_datetime_feedback">

                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="mb-3 col-md-8">
                                <label for="number_of_people" class="form-label">Number of people:</label>
                                <input type="number" class="form-control" id="number_of_people" name="number_of_people" required oninput="validateZooBooking()" min="1" max="<?=MAX_ZOO_VISITORS?>" value="1">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback" id="number_of_people_feedback">

                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="educational_visit" class="form-label">Educational visit?</label>
                                <br>
                                <input type="checkbox" class="form-check-input" id="educational_visit" name="educational_visit">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <a href="tickets.php"><button type="button" class="btn btn-primary mx-auto">See existing tickets</button></a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success mx-auto float-end" id="book_ticket" name="book_ticket">Reserve a ticket</button>
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
        <?php elseif ($role == "admin"): ?>
            <section class="mx-auto col-md-5 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Verify Zoo Ticket</h1>
                    </div>
                    <form action="" method="GET" class="card-body container">
                        <h2 class="text-center mb-4">Ask customer for their booking key:</h2>
                        
                        <div class="row mb-4">
                            <div class="mb-3 col-md-12">
                                <label for="booking_key" class="form-label">Enter customer's booking key</label>
                                <input type="number" class="form-control" id="booking_key" name="booking_key" required onchange="validateZooTicket()">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback" id="booking_key_feedback">

                                </div>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="number_of_people" class="form-label">Enter number of people waiting to be let in:</label>
                                <input type="number" class="form-control" id="number_of_people" name="number_of_people" required onchange="validateZooTicket()">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback" id="number_of_people_feedback">

                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success w-100" id="verify_ticket" name="verify_ticket">Validate Ticket</button>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <?php if (isset($ticket_verified)): ?>
                                <?php if ($ticket_verified->error): ?>
                                    <div class="alert alert-danger" role="alert">
                                        Error - <?=$ticket_verified->error?>
                                    </div>
                                <?php elseif (isset($ticket_verified->result)): ?>
                                    <?php if ($ticket_verified->result): ?>
                                        <div class="alert alert-success" role="alert">
                                            Ticket #<?=$ticket_verified->result["zoo_booking_id"]?> is valid!
                                            <?php if ($ticket_verified->result["active"]): ?>
                                                Ticket is active! Ticketholder is allowed access if <em>exiting</em> the zoo.
                                                <br>
                                                <a href="zoo_booking.php?deactivate_ticket=<?=$ticket_verified->result["zoo_booking_id"]?>"><button type="button" class="btn btn-warning mx-auto w-100 my-3">Deactivate Ticket</button></a>
                                            <?php else: ?>
                                                Ticket is inactive! Ticketholder is allowed access if <em>entering</em> the zoo.
                                                <br>
                                                <a href="zoo_booking.php?activate_ticket=<?=$ticket_verified->result["zoo_booking_id"]?>"><button type="button" class="btn btn-warning mx-auto w-100 my-3">Activate Ticket</button></a>
                                            <?php endif ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="alert alert-danger" role="alert">
                                            Error - ticket is not valid
                                        </div>
                                    <?php endif ?>
                                <?php endif ?>
                            <?php endif ?>
                            <?php if (isset($activated_ticket)): ?>
                                <?php if (isset($activated_ticket->error)): ?>
                                    <div class="alert alert-danger" role="alert">
                                        Error - failed to activate ticket. (<?=$activated_ticket->error?>)
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-success" role="alert">
                                        Activation of ticket successful!
                                    </div>
                                <?php endif ?>
                            <?php elseif (isset($deactivated_ticket)): ?>
                                <?php if (isset($deactivated_ticket->error)): ?>
                                    <div class="alert alert-danger" role="alert">
                                        Error - failed to deactivate ticket. (<?=$deactivated_ticket->error?>)
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-success" role="alert">
                                        Deactivation of ticket successful!
                                    </div>
                                <?php endif ?>
                            <?php endif ?>
                        </div>
                    </form>
                </div>
            </section>
        <?php endif ?>
    </div>
</article>

<?php include_once "include/footer.php";