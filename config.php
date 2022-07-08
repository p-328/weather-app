<?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $creation = "CREATE DATABASE IF NOT EXISTS php_db;";
    $conn->query($creation);
    $sql = "USE php_db;";
    if ($conn->query($sql) == FALSE) {
	 echo ("Error: $conn->error");
	 return;
    } 
    $user_table = "
        CREATE TABLE IF NOT EXISTS users (
            user_id INT PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(255),
            password VARCHAR(500)
        ); 
    ";
    $conn->query($user_table);
    $city_table = "
        CREATE TABLE IF NOT EXISTS cities (
            userId INT,
            CONSTRAINT fk_user FOREIGN KEY(userId) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
            city_name VARCHAR(500),
            country_or_state_of_origin VARCHAR(500)
        );
    ";
    $conn->query($city_table);
