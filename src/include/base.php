<?php

// Utilities are included here, but it should still be included in your page where base.php is included.
// (This line is added to avoid possible errors)
include_once "include/utils.php";

function get_themes($username, $pdo) {
    $fetch = new Fetch();

    try {
        $get_themes = $pdo->prepare(
            "SELECT theme_name, body_color, body_bg,
            secondary, secondary_color, secondary_bg, secondary_bg_subtle, tertiary_color, tertiary_bg, emphasis_color, border_color,
            primary_color, primary_bg_subtle, primary_border_subtle, primary_text_emphasis,
            success, success_bg_subtle, success_border_subtle, success_text_emphasis,
            danger, danger_bg_subtle, danger_border_subtle, danger_text_emphasis,
            warning, warning_bg_subtle, warning_border_subtle, warning_text_emphasis,
            info, info_bg_subtle, info_border_subtle, info_text_emphasis,
            light, light_bg_subtle, light_border_subtle, light_text_emphasis,
            dark, dark_bg_subtle, dark_border_subtle, dark_text_emphasis,
            form_valid_color, form_valid_border_color, form_invalid_color, form_invalid_border_color,
            rza_green, rza_brown, rza_outline_gray
            FROM themes
            WHERE username = :username"
        );
        $get_themes->execute(["username" => $username]);
        $themes = $get_themes->fetchAll();
        $fetch->result = $themes;
    } catch (Exception $e) {
        $fetch->error = $e;
    }

    return $fetch;
}

$username = $_SESSION["user"] ?? FALSE;
if ($username) {
    $themes = get_themes($username, $pdo);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=PAGE_TITLE?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="include/base.css">
        <?php if ($script == "zoo_booking.php"): ?>
            <link rel="stylesheet" href="include/calendar.css">
        <?php endif ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-forced-colors-css@1.0.7/css/bootstrap-forced-colors.min.css" media="screen and (forced-colors: active)">
        <!-- Add extra <link> elements here, such as CSS -->
        <!-- For example: -->

        <!-- <link rel="stylesheet" href="style.css"> -->

        <style>
            <?php if (isset($themes->result)): ?>
                <?php foreach ($themes->result as $theme): ?>
                    <?php include "theme.php"?>
                <?php endforeach ?>
            <?php endif ?>

            /* Add inline CSS here */
        </style>
    </head>
    <body>
        <?php include "header.php" ?>
        <main class="mb-5" style="min-height: 80vh">