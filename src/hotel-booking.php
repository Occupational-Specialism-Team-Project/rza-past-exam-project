<?php

// This lets users book a hotel and shows what dates are available

require_once "include/utils.php";

// PHP:
// input validation
function validate_date($booking_start_date, $booking_end_date) {
    if(empty($booking_start_date) or empty($booking_end_date)) {    // check if any input is empty
        // if input is invalid
        echo "<script>alert('Invalid date')</script>";
    }else if(!strtotime($booking_start_date) or !strtotime($booking_end_date)) {    // check if input is a date
        // if input is invalid
        echo "<script>alert('Invalid date')</script>";
    }else if($booking_start_date > $booking_end_date or $booking_start_date == $booking_end_date) {    // check if the date input is invalid, if end date is before start date or if both dates are the same
        // if input is invalid
        echo "<script>alert('Invalid date')</script>";
    }else {
        // if input is valid
        echo "<script>alert('Valid date')</script>";
    }
}

// when the user submits a reservation request
if(isset($_POST["booking_submit_button"])) {
    // create variables from html form
    $booking_start_date = $_POST["booking_start_date"];
    $booking_end_date = $_POST["booking_end_date"];
    // validate the user inputs
    validate_date($booking_start_date, $booking_end_date);
}



const PAGE_TITLE = "Hotel Booking";
include_once "include/base.php";

?>

<!-- HTML: -->
<div class="container">

    <!-- form for the booking reservation and user inputs -->
    <form method="post">

        <!-- booking arrival date input -->
        <div class="mb-3">
            <label for="booking_start_date" class="form-label">Arrival Date</label>
            <input id="date-start-input" name="booking_start_date" type="date" class="form-control" required>
        </div>

        <!-- booking departure date input -->
        <div class="mb-3">
            <label for="booking_leave_date" class="form-label">Departure Date</label>
            <input id="date-end-input" name="booking_end_date" type="date" class="form-control" min="booking_start_date" required>
        </div>

        <!-- booking submit -->
        <div class="mb-3">
            <button id="booking-submit" class="btn btn-primary" type="submit" name="booking_submit_button">Submit Reservation</button>
        </div>

    </form>
</div>

<?php include_once "include/footer.php";