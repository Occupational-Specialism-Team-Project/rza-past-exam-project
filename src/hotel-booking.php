<?php
// This lets users book a hotel and shows what dates are available

require_once "include/utils.php";


// PHP:


// input validation
function validate_inputs($booking_start_date, $booking_end_date, $booking_room_number) {
    // create formats for the start and end date
    $date_start_validate_format = (DateTime::createFromFormat('Y-m-d', $booking_start_date));
    $date_end_validate_format = (DateTime::createFromFormat('Y-m-d', $booking_end_date));
    // validate start and end date inputs
    if(!($date_start_validate_format && $date_start_validate_format->format('Y-m-d') === $booking_start_date) or !($date_end_validate_format && $date_end_validate_format->format('Y-m-d') === $booking_end_date)) {    // check if input is a valid date and isnt empty
        // if date input is invalid
        echo "<script>alert('Invalid date - Please enter a date in valid format.')</script>";
        return false;
    }else if(($booking_start_date > $booking_end_date) or ($booking_start_date == $booking_end_date)) {    // check if the date input is invalid, if end date is before start date or if both dates are the same
        // if date input is invalid
        echo $booking_start_date, $booking_end_date;
        echo "<script>alert('Invalid date - Please enter a date where the departure date is after the arrival date')</script>";
        return false;
    }else if($booking_start_date < date("Y-m-d")) {    // check if the start date isnt before the current day
        // if date input is invalid
        echo "<script>alert('Invalid date - Please enter a date which isnt before today.')</script>";
        return false;
    }else 
    // continue the else if loop, but now for room number validation
    if(!in_array($booking_room_number, array(1,2,3,4,5))) {    // check if the room number input is a valid room
        // if room number input is invalid
        echo "<script>alert('Invalid room number - Please enter a valid room number.')</script>";
        return false;
    }else{
        // if inputs are valid
        return true;
    }
}




// check if the chosen room is availables
function room_check($pdo, $booking_start_date, $booking_end_date, $booking_room_number) {
    // get all the values in the database which have dates that overlap the chosen date range
    $get_booking_table = $pdo->prepare(
        "SELECT room_number, arrival_date, leave_date FROM hotel_bookings
        WHERE
        room_number = :booking_room_number
        AND
        (
        (:booking_start_date BETWEEN arrival_date AND leave_date) 
        OR 
        (:booking_end_date BETWEEN arrival_date AND leave_date) 
        OR 
        (:booking_start_date < arrival_date) AND (:booking_end_date > leave_date)
        )"
        );
        $get_booking_table_result = $get_booking_table->execute(array(
                                        ":booking_start_date"=>$booking_start_date,
                                        ":booking_end_date"=>$booking_end_date,
                                        ":booking_room_number"=>$booking_room_number));
        $get_booking_table_result = $get_booking_table->fetchAll();


        // if the sql query returned any arrays, then the room is taken
        if($get_booking_table_result == null) {
            // if the room isnt taken
            return "disabled";    // returns disabled so that the room number dropdown options are disabled by javascript
        }else{
            // if the room is taken
            return "";
        }

}


// book the user into the database with the chosen date and room
function book_user($pdo, $user_username, $booking_start_date, $booking_end_date, $booking_room_number) {
    // insert data into the database table hotel_bookings
    $insert_booking_data = $pdo->prepare(
        "INSERT INTO hotel_bookings (username, arrival_date, leave_date, room_number) 
        VALUES (:user_username, :booking_start_date, :booking_end_date, :booking_room_number)");
    $insert_booking_data->execute(array(
        ":user_username"=>$user_username,
        ":booking_start_date"=>$booking_start_date,
        ":booking_end_date"=>$booking_end_date,
        ":booking_room_number"=>$booking_room_number,
    ));
    
    // redirect the user
    echo "<script>alert('successfully booked room')</script>";

}






// program starts running here:


// make sure the user is logged in, if not, redirect them to the login page
if($_SESSION["user"] == false) {
    redirect("login.php");
}else {
    // if the user is logged in, assign their name to a variable
    $user_username = $_SESSION["user"];
}



$booking_start_date = $_POST['booking_start_date'] ?? NULL;
$booking_end_date = $_POST['booking_end_date'] ?? NULL;

// when the user inputs both a valid start date and end date
// go through each room number and for each room number find out if it is available on the users chosen date
$room1_availabe = room_check($pdo, $booking_start_date, $booking_end_date, 1);
$room2_availabe = room_check($pdo, $booking_start_date, $booking_end_date, 2);
$room3_availabe = room_check($pdo, $booking_start_date, $booking_end_date, 3);
$room4_availabe = room_check($pdo, $booking_start_date, $booking_end_date, 4);
$room5_availabe = room_check($pdo, $booking_start_date, $booking_end_date, 5);




// when the user presses the submit button, first do a final validation check of all inputs and then upload them to the database
if(isset($_POST["booking_submit_button"])) {
    // get the users inputs
    $booking_start_date = $_POST['booking_start_date'];
    $booking_end_date = $_POST['booking_end_date'];
    $booking_room_number = $_POST['booking_room_number'];

    // validate user inputs
    if(validate_inputs($booking_start_date, $booking_end_date, $booking_room_number) !== true) {
        // if users input is invalid
        echo "n";
    }else{
        // if users input is valid
        // check to make sure that the room is available to be booked on the chosen date
        if(room_check($pdo, $booking_start_date, $booking_end_date, $booking_room_number) !== "disabled") {    // if the function returns disabled, it means that the room is available. it returns disabled because it is used to disable options in the room number dropdown in the form.
            // if the room isnt available
            echo "<script>alert('Sorry, this room isnt available at this time')</script>";
        }else {
            // if the room is available
            // book the user in on the chosen date and room
            book_user($pdo, $user_username, $booking_start_date, $booking_end_date, $booking_room_number);
        }
    }
}



const PAGE_TITLE = "Hotel Booking";
include_once "include/base.php";

?>

<!-- HTML: -->
<div class="container">

    <!-- form for the booking reservation and user inputs -->
    <form id="booking_form" method="post">

        <!-- booking arrival date input -->
        <div class="mb-3">
            <label for="booking_start_date" class="form-label">Arrival Date</label>
            <input id="date-start-input" oninput="booking_start_date_inputted()" name="booking_start_date" type="date" class="form-control" value="<?= $booking_start_date ?>" required>
            <!-- validation error messages for date start input -->
            <div id="date_start_input_empty" class="invalid-feedback">Start date cannot be empty</div>
            <div id="date_start_input_beforeToday" class="invalid-feedback">Start date cannot be before the current day</div>
            <div id="date_start_input_afterEnd" class="invalid-feedback">Start date has to be before the end date</div>
        </div>

        <!-- booking departure date input -->
        <div class="mb-3">
            <label for="booking_leave_date" class="form-label">Departure Date</label>
            <input id="date-end-input" oninput="booking_end_date_inputted()" name="booking_end_date" type="date" class="form-control" value="<?= $booking_end_date ?>" required>
            <!-- validation error messages for date end input -->
            <div id="date_end_input_empty" class="invalid-feedback">End date cannot be empty</div>
            <div id="date_end_input_beforeStart" class="invalid-feedback">End date has to be after the start date</div>
        </div>

        <!-- booking room select input dropdown menu -->
        <label for="booking-room-select" class="form-label">Room Number</label>
        <select id="booking-room-input" oninput="booking_room_number_inputted()" name="booking_room_number" title="please enter valid booking dates first" class="mb-3" disabled required>



        <script>
                // after the user updates their date inputs and the data is posted to php, the page is reloaded. when this reload happens, check if each room is available
                window.onload = function update_available_rooms() {
                    var date_start_input = document.getElementById("date-start-input").value;
                    var date_end_input = document.getElementById("date-end-input").value;
                    // find out if the user has input for both start and end date
                    if(isNaN(Date.parse(date_end_input)) || isNaN(Date.parse(date_start_input))) {
                        // if either date input is invalid

                    }else{
                        // if both date inputs are valid
                        // enable the rooms dropdown and remove the hover text
                        document.getElementById("booking-room-input").removeAttribute("disabled");
                        document.getElementById("booking-room-input").removeAttribute("title");
                        // check for available rooms on the date, disable dropdown items for rooms that are not available
                        // first, disable all room number select options
                        document.getElementById("room1_option").setAttribute("disabled", "disabled");
                        document.getElementById("room2_option").setAttribute("disabled", "disabled");
                        document.getElementById("room3_option").setAttribute("disabled", "disabled");
                        document.getElementById("room4_option").setAttribute("disabled", "disabled");
                        document.getElementById("room5_option").setAttribute("disabled", "disabled");
                        // after, enable each room that is available
                        document.getElementById("room1_option").removeAttribute("<?= $room1_availabe ?>");
                        document.getElementById("room2_option").removeAttribute("<?= $room2_availabe ?>");
                        document.getElementById("room3_option").removeAttribute("<?= $room3_availabe ?>");
                        document.getElementById("room4_option").removeAttribute("<?= $room4_availabe ?>");
                        document.getElementById("room5_option").removeAttribute("<?= $room5_availabe ?>");
                }

                if(!document.getElementById("booking-room-input").hasAttribute("disabled")) {
                    validate_start_date(document.getElementById("date-start-input").value, document.getElementById("date-end-input").value);
                    validate_end_date(document.getElementById("date-end-input").value, document.getElementById("date-start-input").value);
                }

                }

                


                // when the user enters a room number
                function booking_room_number_inputted() {
                    var booking_room_input = document.getElementById("booking-room-input");
                    booking_room_input.onchange = function () {
                        
                        document.getElementById("booking-submit").removeAttribute("disabled");
                    }
                }
                

                // when the user enters an arrival date
                function booking_start_date_inputted() {
                    // get the users input
                    var date_start_input = document.getElementById("date-start-input");
                    date_start_input.onchange = function()
                    {
                            document.getElementById("booking-room-input").setAttribute("disabled", "disabled");

                            var date_start_input = document.getElementById("date-start-input").value;
                            var date_end_input = document.getElementById("date-end-input").value;
                            validate_start_date(date_start_input, date_end_input);
                            validate_end_date(date_end_input, date_start_input);
                            // enable the submit button if all inputs are valid
                            if(document.getElementById("date-start-input").classList.contains("is-valid") && document.getElementById("date-end-input").classList.contains("is-valid")) {
                                // enable the button
                                document.getElementById("booking-submit").removeAttribute("disabled");
                                document.getElementById("booking_form").submit();
                            }else{
                                // disable the button
                                document.getElementById("booking-submit").setAttribute("disabled", "disabled");
                            }
                            // submit POST data of both the user inputted start and end date
                            
                    }
                }


                // when the user enters a departure date
                function booking_end_date_inputted() {
                    // get the users input
                    var date_end_input = document.getElementById("date-end-input");
                    date_end_input.onchange = function()
                    {
                            document.getElementById("booking-room-input").setAttribute("disabled", "disabled");

                            var date_end_input = document.getElementById("date-end-input").value;
                            var date_start_input = document.getElementById("date-start-input").value;
                            validate_end_date(date_end_input, date_start_input);
                            validate_start_date(date_start_input, date_end_input);
                            // enable the submit button if all inputs are valid
                            if(document.getElementById("date-start-input").classList.contains("is-valid") && document.getElementById("date-end-input").classList.contains("is-valid")) {
                                // enable the button
                                document.getElementById("booking-submit").removeAttribute("disabled");
                                document.getElementById("booking_form").submit();           // ERROR here - for some reason submits form whenever end date is inputted
                            }else{
                                // disable the button
                                document.getElementById("booking-submit").setAttribute("disabled", "disabled");
                            }
                            // submit POST data of both the user inputted start and end date
                            

                    }
                }
// document.getElementById("booking_form").submit();



                // validation functions:

                // start date validation
                function validate_start_date(date_start_input, date_end_input) {
                    // check if the start date is empty
                    if(isNaN(Date.parse(date_start_input))) {
                        // if the input is invalid
                        document.querySelector("#date_start_input_empty").style.display="block";
                        document.getElementById("date-start-input").classList.remove("is-valid");
                        document.getElementById("date-start-input").classList.add("is-invalid");

                    }else{
                        // if the input is valid
                        document.querySelector("#date_start_input_empty").style.display="none";
                        document.getElementById("date-start-input").classList.remove("is-invalid");
                        document.getElementById("date-start-input").classList.add("is-valid");
                    }

                    // check if the start date isnt set to a date before the current day
                    var current_date = new Date().getFullYear() + "-" + (new Date().getMonth()+1) + "-" + new Date().getDate();
                    Sdate1 = Date.parse(date_start_input);
                    Sdate2 = Date.parse(current_date);
                    if(Sdate1 < Sdate2) {
                        // if the input is invalid
                        document.querySelector("#date_start_input_beforeToday").style.display="block";
                        document.getElementById("date-start-input").classList.remove("is-valid");
                        document.getElementById("date-start-input").classList.add("is-invalid");

                    }else{
                        // if the input is valid
                        document.querySelector("#date_start_input_beforeToday").style.display="none";
                        document.getElementById("date-start-input").classList.remove("is-invalid");
                        document.getElementById("date-start-input").classList.add("is-valid");
                    }

                    // check if start date is after end date
                    if(!isNaN(Date.parse(date_end_input))) {
                    if(date_end_input <= date_start_input) {
                        // if the input is invalid
                        document.querySelector("#date_start_input_afterEnd").style.display="block";
                        document.getElementById("date-start-input").classList.remove("is-valid");
                        document.getElementById("date-start-input").classList.add("is-invalid");
;
                    }else{
                        // if the input is valid
                        document.querySelector("#date_start_input_afterEnd").style.display="none";
                        document.getElementById("date-start-input").classList.remove("is-invalid");
                        document.getElementById("date-start-input").classList.add("is-valid");
                    }

                }

                }

                // end date validation
                function validate_end_date(date_end_input, date_start_input) {
                    // check if the start end is empty
                    if(isNaN(Date.parse(date_end_input))) {
                        // if the input is invalid
                        document.querySelector("#date_end_input_empty").style.display="block";
                        document.getElementById("date-end-input").classList.remove("is-valid");
                        document.getElementById("date-end-input").classList.add("is-invalid");

                    }else{
                        // if the input is valid
                        document.querySelector("#date_end_input_empty").style.display="none";
                        document.getElementById("date-end-input").classList.remove("is-invalid");
                        document.getElementById("date-end-input").classList.add("is-valid");
                    }

                    // check if end date is before start date
                    if(!isNaN(Date.parse(date_start_input))) {
                    if(date_end_input <= date_start_input) {
                        // if the input is invalid
                        document.querySelector("#date_end_input_beforeStart").style.display="block";
                        document.getElementById("date-end-input").classList.remove("is-valid");
                        document.getElementById("date-end-input").classList.add("is-invalid");
;
                    }else{
                        // if the input is valid
                        document.querySelector("#date_end_input_beforeStart").style.display="none";
                        document.getElementById("date-end-input").classList.remove("is-invalid");
                        document.getElementById("date-end-input").classList.add("is-valid");
                    }

                }
                }





        </script>

            <option id="room1_option">1</option>
            <option id="room2_option">2</option>
            <option id="room3_option">3</option>
            <option id="room4_option">4</option>
            <option id="room5_option">5</option>

        </select>

        <!-- booking submit -->
        <div class="mb-3">
            <button id="booking-submit" class="btn btn-primary" type="submit" name="booking_submit_button" disabled>Submit Reservation</button>
        </div>

    </form>
</div>




<?php include_once "include/footer.php";






// check if the other date input, in this case the arrival date, is empty or not. if it is empty then dont do anything, otherwise check for available rooms on the date and disable the dropdown inputs for unavailable rooms
// var date_start_input = document.getElementById("date-start-input").value;
// if(isNaN(Date.parse(date_start_input))) {    // find out if the other date input is empty
//     // if other input is empty
    
// }else{
//     // submit POST data of both the user inputted start and end date
//     var date_end_input = document.getElementById("date-end-input").value;
//     validate_dates(date_start_input, date_end_input);
//     // document.getElementById("booking_form").submit();
// }