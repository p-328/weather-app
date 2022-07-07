<?php
    function get_weather_data(string $city, string $country) {
        $ch = curl_init();

        $url = "https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/" . $city . "," . $country . "?key=FALECPCEQPM3LKNR9CNFEJCAX";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $content = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpcode == 400) {
            return -1;
        } else {
            $results = json_decode($content, true)['days'];

            return array_map("get_day_data", $results);
        }
    }
    function get_day_data($item) {
        $array_temps = [
            'max' => $item['tempmax'],
            'min' => $item['tempmin'],
            'humidity' => $item['humidity'],
            'date' => $item['datetime']
        ];
        return $array_temps;
    }
    