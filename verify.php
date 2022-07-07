<?php
    include 'config.php';
    include 'index.php';
    $err_msg_template = "
        <div class='err-msg'>
            <p>Invalid credentials!</p>
        </div>
    ";
    session_start();
    error_reporting(E_ERROR);
    if (!isset($_GET['username']) || !isset($_GET['password'])) {
        echo("Invalid credentials!");
        return;
    }
    $username = $conn->real_escape_string(htmlspecialchars($_GET['username']));
    $password = $conn->real_escape_string(htmlspecialchars($_GET['password']));
    $username_stmt = $conn->stmt_init();
    $username_query = "SELECT * FROM users WHERE username=? LIMIT 1;";
    if (!$username_stmt->prepare($username_query)) {
        echo("Failed to prime statement!");
        return;
    }
    $username_stmt->bind_param("s", $username);
    $username_stmt->execute();
    $found = $username_stmt->get_result();
    if ($found->num_rows == 0) {
        echo($err_msg_template);
        return;
    } 
    $row = $found->fetch_assoc();
    if (!password_verify($password, $row["password"])) {
        echo($err_msg_template);
        return;
    } 
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $row["user_id"];
    header("Location: /weather-app/weather-for-cities");
