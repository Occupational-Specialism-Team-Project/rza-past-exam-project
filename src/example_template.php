<?php

// This connects to the database and starts a session.
// It also provides several utility functions that wrap common functionality
// so it can be used across different pages.
require_once "include/utils.php";

// This will decide the name of the <title> element in `base.php` (name assigned to the tab).
const PAGE_TITLE = "Example Template";
include_once "include/base.php";

?>

<!-- Place your HTML here -->
<h1><?=PAGE_TITLE?></h1>
<p>This is an example template for what PHP pages/scripts should be formatted like.</p>
<p>
Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus nobis ipsam fugit a repellat natus id ea,
aliquam tempora voluptatem temporibus esse?
Aut id ipsam nemo quisquam quidem deserunt eligendi.
</p>
<button>Lorem ipsum dolor sit amet consectetur adipisicing elit.</button>

<!-- Don't forget to include the footer at the end so the closing tags can work with the remaining base content -->
<?php include_once "include/footer.php";