<?php

function redirect($url) {
    $current_path = dirname($_SERVER["PHP_SELF"]);
    $absolute_url = "$current_path/$url";
    header("Location: $absolute_url");
    exit();
}

class Fetch {
    public $result;
    public $error;
}

require_once "connect.php";

if ((session_status() !== PHP_SESSION_ACTIVE) and (session_status() === PHP_SESSION_NONE)) {
    $start_session = session_start();

    if (! $start_session) {
        redirect("error.php");
    }
}

require "server_settings.php";