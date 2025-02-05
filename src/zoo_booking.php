<?php

require_once "include/utils.php";

$user = $_SESSION["user"];
$role = $_SESSION["role"];

const PAGE_TITLE = "Zoo Booking";
include_once "include/base.php";

?>

<h1><?=PAGE_TITLE?></h1>
<?=$user?>
<br>
<?=$role?>

<?php include_once "include/footer.php";