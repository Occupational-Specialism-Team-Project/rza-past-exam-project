<?php

require_once "include/utils.php";

function get_zoo_tickets($username, $pdo) {
    $fetch = new Fetch();

    try {
        $get_zoo_tickets = $pdo->prepare(
            "SELECT zoo_booking_id, start_datetime, end_datetime, number_of_people, educational_visit, booking_key, active
            FROM zoo_bookings
            WHERE (username = :username) AND (end_datetime >= NOW())"
        );
        $get_zoo_tickets->execute(["username"=>$username]);
        $zoo_tickets = $get_zoo_tickets->fetchAll();

        $fetch->result = $zoo_tickets;
    } catch (Exception $e) {
        $fetch->error = $e;
    }

    return $fetch;
}

function cancel_booking($id, $pdo) {
    $fetch = new Fetch();

    try {
        $cancel_booking = $pdo->prepare("DELETE FROM zoo_bookings WHERE zoo_booking_id = :id");
        $cancelled_booking = $cancel_booking->execute(["id" => $id]);

        $fetch->result = $cancelled_booking;
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
if (! $role == "customer") {
    redirect("index.php");
}

$tickets = get_zoo_tickets($_SESSION["user"], $pdo);

if (isset($_GET["delete"])) {
    $cancelled_booking = cancel_booking($_GET["delete"], $pdo);
    if (isset($cancelled_booking->error)) {
        redirect("tickets.php?success=0");
    } else {
        redirect("tickets.php?success=1");
    }
}

const PAGE_TITLE = "Zoo Tickets";
include_once "include/base.php";

?>

<article class="container-fluid">
    <div class="row">
        <section class="col-md-5 mx-auto mt-5">
            <div class="card">
            <div class="card-header">
                <h1 class="card-title text-center"><?=PAGE_TITLE?></h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID (#)</th>
                                <th scope="col">Start Date & Time:</th>
                                <th scope="col">End Date & Time:</th>
                                <th scope="col">Number of People:</th>
                                <th scope="col">Educational Visit?</th>
                                <th scope="col">Active?</th>
                                <th scope="col">View</th>
                                <th scope="col">Cancel</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tickets->result as $ticket): ?>
                                <tr>
                                    <th scope="row"><?=$ticket["zoo_booking_id"]?></th>
                                    <td><?=$ticket["start_datetime"]?></td>
                                    <td><?=$ticket["end_datetime"]?></td>
                                    <td><?=$ticket["number_of_people"]?></td>
                                    <td><?=$ticket["educational_visit"] ? "Yes" : "No"?></td>
                                    <td><?=$ticket["active"] ? "Yes" : "No"?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ticket_<?=$ticket["zoo_booking_id"]?>">View</button>
                                        <div id="ticket_<?=$ticket["zoo_booking_id"]?>" class="modal" tabindex="-1" aria-labelledby="ticket_<?=$ticket["zoo_booking_id"]?>_label">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ticket_<?=$ticket["zoo_booking_id"]?>_label">View Ticket #<?=$ticket["zoo_booking_id"]?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <p>Show this to a member of staff upon entry or exit.</p>
                                                        <p>Booking key:</p>
                                                        <i><b style="font-size: 3rem" class="rza-green rza-brand rounded-5 p-2"><?=$ticket["booking_key"]?></b></i>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancel_<?=$ticket["zoo_booking_id"]?>">Cancel</button>
                                        <div id="cancel_<?=$ticket["zoo_booking_id"]?>" class="modal" tabindex="-1" aria-labelledby="cancel_<?=$ticket["zoo_booking_id"]?>_label">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="cancel_<?=$ticket["zoo_booking_id"]?>_label"><b>DANGER:</b> Delete Ticket #<?=$ticket["zoo_booking_id"]?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <p>Are you sure you want to cancel this booking? This will not be refunded.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <a href="?delete=<?=$ticket["zoo_booking_id"]?>"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel Booking</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <?php if (isset($tickets->error)): ?>
                    <div class="alert alert-danger" role="alert">
                        Error - unable to obtain zoo tickets.
                    </div>
                <?php endif ?>
                <?php if (isset($_GET["success"])): ?>
                    <?php if ($_GET["success"]): ?>
                        <div class="alert alert-success" role="alert">
                            Successfully cancelled zoo tickets.
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger" role="alert">
                            Error - unable to cancel zoo tickets.
                        </div>
                    <?php endif ?>
                <?php endif ?>
            </div>
        </section>
    </div>
</article>

<?php include_once "include/footer.php";