<?php include_once "include/utils.php" ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=PAGE_TITLE?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="include/login.css">
        <style>
            .carousel-index-image {
                min-height:25vh;
                width: 100%;
            }

            .rza-green {
                background-color: #4B6F44;
            }

            .rza-brand {
                text-shadow: -1px -1px 0 lightgray, 0.5px -1px 0 lightgray, -1px 0.5px 0 lightgray, 0.5px 0.5px 0 lightgray;
                font-weight: bold;
                color: #645452;
            }

            .shadow-up {
                box-shadow: 0 -0.5rem 1rem rgba(0, 0, 0, 0.15);
            }
        </style>
    </head>
    <body>
        <?php include "header.php" ?>
        <main style="min-height: 80vh">