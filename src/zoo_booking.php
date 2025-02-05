<?php

require_once "include/utils.php";

$user = $_SESSION["user"];
$role = $_SESSION["role"];

# Validate user session and redirect if invalid
if (! (isset($user) and isset($role))) {
    redirect("login.php");
}
if ($_SESSION["role"] != "customer") {
    redirect("index.php");
}

const PAGE_TITLE = "Zoo Booking";
include_once "include/base.php";

?>

<article class="container-fluid">
    <div class="row">
        <section class="mx-auto col-md-4 mt-5">
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
                    <div class="row">
                        <?=var_dump($zoo_visit)?>
                    </div>

                </form>
            </div>
        </section>
    </div>
</article>

<?php include_once "include/footer.php";