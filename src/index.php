<?php

require_once "include/utils.php";

const PAGE_TITLE = "Home Page";
include_once "include/base.php";

?>

<article class="container-fluid">
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
                        <button class="carousel-control-prev carousel-dark" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next carousel-dark" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>

<?php include_once "include/footer.php";