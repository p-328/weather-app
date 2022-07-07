<!DOCTYPE html>
<html>

<head>
    <title>WeatherMan!</title>
    <link rel="stylesheet" href="assets/styles.css" type="text/css">
    <link rel="icon" href="assets/WeatherMan!.png">
</head>

<body class="bg">
    <div class="center">
        <?php
            ob_start();
            session_start();
            if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
                header('Location: /weather-app/weather-for-cities');
            }
        ?>
        <img src="./assets/WeatherMan!.png" class="logo">
        <h1>Login</h1>
        <form action="verify.php" method="GET">
            <label>Username: </label>
            <br>
            <input type="text" name="username" class="input-form-login" required>
            <br><br>
            <label>Password: </label>
            <br>
            <input type="password" name="password" class="input-form-login" required>
            <br><br>
            <input type="submit" value="Login" class="btn-submit">
        </form>
        <p>Have no account? Create one <a href="create-account">here</a>!</p>
    </div>
</body>

</html>