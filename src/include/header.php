<?php require_once "utils.php" ?>

<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand fs-2" href="#">
                RZA
                <i class="fa-solid fa-paw"></i>
            </a>
            <button class="navbar-toggler fs-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse fs-2" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link<?php if (PAGE_TITLE == "Home Page"): echo " active"; endif ?>" <?php if (PAGE_TITLE == "Home Page"): echo "aria-current='page'"; endif ?> href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php if (PAGE_TITLE == "Example Template"): echo " active"; endif ?>" <?php if (PAGE_TITLE == "Example Template"): echo "aria-current='page'"; endif ?> href="example_template.php">Example</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php if (PAGE_TITLE == "Learning Material"): echo " active"; endif ?>" <?php if (PAGE_TITLE == "Learning Material"): echo "aria-current='page'"; endif ?> href="index.php">Learning Material</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle<?php if (PAGE_TITLE == "Zoo Bookings" or PAGE_TITLE == "Hotel Bookings"): echo " active"; endif ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Bookings
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item<?php if (PAGE_TITLE == "Zoo Bookings"): echo " active"; endif ?>" href="#">Zoo</a></li>
                            <li><a class="dropdown-item<?php if (PAGE_TITLE == "Hotel Bookings"): echo " active"; endif ?>" href="#">Hotel</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php if (PAGE_TITLE == "Attractions & Facilities"): echo " active"; endif ?>" <?php if (PAGE_TITLE == "Attractions & Facilities"): echo "aria-current='page'"; endif ?> href="index.php">Attractions & Facilities</a>
                    </li>
                </ul>
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
            </div>
        </div>
    </nav>
</header>