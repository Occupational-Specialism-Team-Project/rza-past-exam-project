<?php

require_once "include/utils.php";

const PAGE_TITLE = "Home Page";
include_once "include/base.php";

?>

<article class="container-fluid my-3">
    <section class="row mb-5">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h1 class="text-center text-white fw-normal">Welcome to Riget Zoo Adventures! Explore what we have to offer...</h1>
                </div>
                <div class="card-body bg-secondary-subtle">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="images/lion_image.jpg" class="d-block carousel-index-image mx-auto rounded-5" alt="Photo of a lion standing on a tree branch">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Take a look at some of our majestic lions!</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="images/parrot_image.jpg" class="d-block carousel-index-image mx-auto rounded-5" alt="Photo of a red macaw from the side">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Introducing the new red macaw!</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="images/hippo_image.jpg" class="d-block carousel-index-image mx-auto rounded-5" alt="Photo of an adult hippopotamus and baby hippopotamus eating from the ground">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>We also have hippopotamuses.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="row mx-auto">
        <div class="col-md-3 mb-5">
            <div class="card" style="height: 400px">
                <div class="card-header">
                    <h5 class="card-title">Help & Information</h5>
                </div>
                <i class="card-img-top fa-solid fa-circle-info text-center p-3" style="font-size: 10rem"></i>
                <div class="card-body d-flex flex-column justify-content-between">
                    <p class="card-text">View help and information about the attractions and facilities.</p>
                    <a href="#" class="btn btn-primary">Navigate Here</a>
                </div>
            </div>
        </div>
        <?php if (isset($_SESSION["user"])): ?>
            <div class="col-md-3 mb-5">
                <div class="card" style="height: 400px">
                    <div class="card-header">
                        <h5 class="card-title">Zoo Bookings & Reservations</h5>
                    </div>
                    <i class="card-img-top fa-solid fa-hippo text-center p-3" style="font-size: 10rem"></i>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <p class="card-text">Book and reserve zoo tickets.</p>
                        <a href="zoo_booking.php" class="btn btn-primary">Navigate Here</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-5">
                <div class="card" style="height: 400px">
                    <div class="card-header">
                        <h5 class="card-title">Log Out</h5>
                    </div>
                    <i class="card-img-top fa-solid fa-arrow-right-to-bracket text-center p-3" style="font-size: 10rem"></i>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <p class="card-text">Log out of the currently logged-into account.</p>
                        <a href="#" class="btn btn-primary">Logout</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-5">
                <div class="card" style="height: 400px">
                    <div class="card-header">
                        <h5 class="card-title">Account Settings</h5>
                    </div>
                    <i class="card-img-top fa-solid fa-user text-center p-3" style="font-size: 10rem"></i>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <p class="card-text">View account settings, including accessibility features.</p>
                        <a href="user_settings.php" class="btn btn-primary">Navigate Here</a>
                    </div>
                </div>
            </div>
            <?php if (isset($_SESSION["role"])): ?>
                <div class="col-md-3 mb-5">
                    <div class="card" style="height: 400px">
                        <div class="card-header">
                            <h5 class="card-title">Educational Materials</h5>
                        </div>
                        <i class="card-img-top fa-solid fa-school text-center p-3" style="font-size: 10rem"></i>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <p class="card-text">Provision of materials for educational visits.</p>
                            <a href="#" class="btn btn-primary">Navigate Here</a>
                        </div>
                    </div>
                </div>
                <?php if ($_SESSION["role"] == "customer"): ?>
                    <div class="col-md-3 mb-5">
                        <div class="card" style="height: 400px">
                            <div class="card-header">
                                <h5 class="card-title">Hotel Bookings</h5>
                            </div>
                            <i class="card-img-top fa-solid fa-hotel text-center p-3" style="font-size: 10rem"></i>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <p class="card-text">Check availability and book a hotel in advance.</p>
                                <a href="#" class="btn btn-primary">Navigate Here</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-5">
                        <div class="card" style="height: 400px">
                            <div class="card-header">
                                <h5 class="card-title">Loyalty & Reward Scheme</h5>
                            </div>
                            <i class="card-img-top fa-solid fa-tag text-center p-3" style="font-size: 10rem"></i>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <p class="card-text">Conditional discounts with code redemption.</p>
                                <a href="#" class="btn btn-primary">Navigate Here</a>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            <?php endif ?>
        <?php else: ?>
            <div class="col-md-3 mb-5">
                <div class="card" style="height: 400px">
                    <div class="card-header">
                        <h5 class="card-title">Register Account</h5>
                    </div>
                    <i class="card-img-top fa-regular fa-user text-center p-3" style="font-size: 10rem"></i>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <p class="card-text">Sign up / register an account with RZA.</p>
                        <a href="#" class="btn btn-primary">Register</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-5">
                <div class="card" style="height: 400px">
                    <div class="card-header">
                        <h5 class="card-title">Log In</h5>
                    </div>
                    <i class="card-img-top fa-solid fa-right-to-bracket text-center p-3" style="font-size: 10rem"></i>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title">Log In</h5>
                        <p class="card-text">Log into an existing account.</p>
                        <a href="#" class="btn btn-primary">Login</a>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </section>
</article>

<?php include_once "include/footer.php";