<?php require_once "utils.php" ?>

<header class="shadow sticky-top">
    <nav class="navbar navbar-expand-lg navbar-dark rza-green">
        <div class="container-fluid">
            <a class="navbar-brand fs-2 rza-brand" href="index.php">
                RZA
                <i class="fa-solid fa-paw"></i>
            </a>
            <button class="navbar-toggler fs-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse fs-3" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link<?php if (PAGE_TITLE == "Home Page"): echo " active"; endif ?>" <?php if (PAGE_TITLE == "Home Page"): echo "aria-current='page'"; endif ?> href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php if (PAGE_TITLE == "Example Template"): echo " active"; endif ?>" <?php if (PAGE_TITLE == "Example Template"): echo "aria-current='page'"; endif ?> href="example_template.php">Example</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php if (PAGE_TITLE == "Learning Materials"): echo " active"; endif ?>" <?php if (PAGE_TITLE == "Learning Materials"): echo "aria-current='page'"; endif ?> href="upload_files.php">Learning Materials</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle<?php if (PAGE_TITLE == "Zoo Booking" or PAGE_TITLE == "Zoo Tickets" or PAGE_TITLE == "Hotel Booking"): echo " active"; endif ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Bookings
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item<?php if (PAGE_TITLE == "Zoo Booking" or PAGE_TITLE == "Zoo Tickets"): echo " active"; endif ?>" href="zoo_booking.php">Zoo</a></li>
                            <li><a class="dropdown-item<?php if (PAGE_TITLE == "Hotel Booking"): echo " active"; endif ?>" href="#">Hotel</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php if (PAGE_TITLE == "Attractions & Facilities"): echo " active"; endif ?>" <?php if (PAGE_TITLE == "Attractions & Facilities"): echo "aria-current='page'"; endif ?> href="index.php">Attractions & Facilities</a>
                    </li>
                </ul>
                <div class="dropdown">
                    <button class="btn <?=isset($_SESSION["user"]) ? "btn-success" : "btn-outline-light"?> dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="<?=isset($_SESSION["user"]) ? "fa-solid" : "fa-regular"?> fa-user"></i>
                        <?=$_SESSION["user"] ?? "Not logged in"?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <?php if (! isset($_SESSION["user"])): ?>
                            <li><a class="dropdown-item" href="login.php">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                Log in
                            </a></li>
                            <li><a class="dropdown-item" href="sign_up.php">
                                <i class="fa-solid fa-user-plus"></i>
                                Sign up
                            </a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="#">
                                <i class="fa-solid fa-gear"></i>
                                Settings
                            </a></li>
                            <li><a class="dropdown-item" href="logout.php">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                Log out
                            </a></li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>