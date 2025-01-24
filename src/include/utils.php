<?php

function redirect($url) {
    $current_path = dirname($_SERVER["PHP_SELF"]);
    $absolute_url = "$current_path/$url";
    header("Location: $absolute_url");
    exit();
}

$start_session = session_start();
if (! $start_session) {
    redirect("error.php");
}