<?php

function redirect($url) {
    $current_path = dirname($_SERVER["PHP_SELF"]);
    $absolute_url = "$current_path/$url";
    header("Location: $absolute_url");
    exit();
}

function clean_hex_color($hex) {
    $hex = strtolower($hex);
    if (strlen($hex) == 7 || strlen($hex) == 4)
        $hex = substr($hex, -(strlen($hex) - 1));

    if (preg_match('/^[a-f0-9]{6}$/i', $hex))
        return "#$hex";
    elseif (preg_match('/^[a-f0-9]{3}$/i', $hex))
        return "#$hex[0]$hex[0]$hex[1]$hex[1]$hex[2]$hex[2]";
    else
        return "#000000";
}

function hex_to_rgb($hex, $alpha = FALSE) {
    $hex = str_replace('#', '', $hex);
    $length = strlen($hex);

    $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
    $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
    $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
    if ( $alpha ) {
       $rgb['a'] = $alpha;
    }

    return implode(", ", $rgb);
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

$script = basename($_SERVER["PHP_SELF"]);

require "server_settings.php";