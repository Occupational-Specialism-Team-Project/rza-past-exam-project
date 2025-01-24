<?php

try {
    $settings = parse_ini_file("db_settings.ini");
    $dsn = "mysql:
            host=". $settings['host'] . ";" .
            "dbname=". $settings['dbname'] . ";" .
            "username=". $settings['username'] . ";" .
            "password=". $settings['password'] . ";"
    ;

    // create a PDO instance
    $pdo = new PDO($dsn, $settings["username"], $settings["password"]);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // handle connection error
    redirect("include/error.php");
    echo "There was a problem with the database connection". $e->getMessage();
}