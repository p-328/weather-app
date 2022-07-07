<!DOCTYPE html>
<html>

<head>
    <title>My Cities</title>
    <link rel="stylesheet" href="../assets/styles.css" type="text/css">
    <link rel="icon" href="../assets/WeatherMan!.png">
</head>

<body>
    <?php
    include '../config.php';
    include './get_weather_data.php';
    session_start();
    if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
        $user = $_SESSION['username'];
        $user_id = $_SESSION['user_id'];
        echo ("<h1>Hello, $user!</h1>");
        echo ("<h2>Here is a list of all your cities:</h2>");
        $all_cities = $conn->query("SELECT * FROM cities WHERE userId = $user_id;");
        if ($all_cities->num_rows > 0) {
            while ($row = $all_cities->fetch_assoc()) {
                $city_name = $row["city_name"];
                $country_state = $row["country_or_state_of_origin"];
                $data = get_weather_data($city_name, $country_state);
                $template = "
                            <li class='city-state'>
                                <div>
                                    <p>$city_name, $country_state</p>
                                </div>
                            </li>
                        ";
                echo ($template);
                foreach ($data as $day) {
                    $max = $day['max'];
                    $min = $day['min'];
                    $humidity = $day['humidity'];
                    $date = $day['date'];
                    $template_for_data = "
                                <li class='display'>
                                    <div class='weather-detail'>
                                        <ul>
                                            <li><strong>$date</strong></li>
                                            <li><strong>High: $max</strong></li>
                                            <li><strong>Low: $min</strong></li>
                                            <li><strong>Humidity: $humidity</strong></li>
                                        </ul>
                                    </div>
                                </li>
                            ";
                    echo ($template_for_data);
                }
            }
        }
        $page_template = "
                    <form action='create_city.php' methods='GET'>
                        <label>City Name: </label>
                        <br>
                        <input type='text' name='city_name' class='input-form' required></input>
                        <br>
                        <br>
                        <label>Country/State:</label>
                        <br>
                        <input type='text' name='country_or_state' class='input-form' required></input>
                        <br>
                        <br>
                        <input type='submit' class='btn-submit' value='+ Add City'></input>
                    </form>
                ";
        echo ($page_template);
        echo ("<a href='logout.php' class='logout-link'>Logout</a><br>");
    } else {
        header('Location: /weather-app');
    }
    ?>

</body>

</html>