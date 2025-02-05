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
                    <h1><?=PAGE_TITLE?></h1>
                </div>
                <div class="card-body">
                    <h2>Feeling adventurous? Book a visit to our zoo:</h2>
                    
                    <p class="card-text">
                        <?=$user?>
                    </p>
                    <p class="card-text">
                        <?=$role?>
                    </p>

                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </section>
    </div>
</article>

<?php include_once "include/footer.php";