<?php

// Utilities are included here, but it should still be included in your page where base.php is included.
// (This line is added to avoid possible errors)
include_once "include/utils.php"

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=PAGE_TITLE?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Add extra <link> elements here, such as CSS -->
        <!-- For example: -->

        <!-- <link rel="stylesheet" href="style.css"> -->

        <style>
            /* Add inline CSS here */
            .carousel-index-image {
                min-height:25vh;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <?php include "header.php" ?>
        <main>