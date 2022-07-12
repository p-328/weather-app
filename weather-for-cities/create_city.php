<?php
    ob_start();
    include '../config.php';
    include './index.php';
    error_reporting(E_ERROR);
    session_start();
    if (!isset($_GET['city_name']) || !isset($_GET['country_or_state'])) {
        echo('Missing fields!');
        return;
    }
    $city_name = $_GET["city_name"];
    $country_or_state = $_GET["country_or_state"];
    $user_id = $_SESSION["user_id"];

    $sql_query = "INSERT INTO cities(userId, city_name, country_or_state_of_origin) VALUES (?, ?, ?);";
    $creation_stmt = $conn->stmt_init();

    if (!$creation_stmt->prepare($sql_query)) {
        echo("Could not prepare statement.");
        return;
    }
    if (get_weather_data($city_name, $country_or_state) == -1) {
        echo("That location does not exist.");
        return;
    }
    $creation_stmt->bind_param("iss", $user_id, $city_name, $country_or_state);
    $creation_stmt->execute();
    header("Location: index.php");
    exit();
    
