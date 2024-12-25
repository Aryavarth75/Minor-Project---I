<?php
$apiKey = "aryavarth75"; // Replace with your OpenWeatherMap API key
$city = "Jhabua"; // Replace with the city you want to get weather for
$units = "metric"; // Use "imperial" for Fahrenheit
$apiUrl = "https://api.openweathermap.org/data/2.5/weather?q={$city}&units={$units}&appid={$apiKey}";

// Initialize a CURL session to fetch data
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $apiUrl);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);

// Decode the JSON response
$data = json_decode($response, true);

// Check if the data was retrieved successfully
if ($data && $data['cod'] == 200) {
    $temperature = $data['main']['temp'];
    $description = $data['weather'][0]['description'];
    $icon = $data['weather'][0]['icon'];
    $iconUrl = "https://openweathermap.org/img/wn/{$icon}.png";
} else {
    echo "Weather data not available.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather Status</title>
</head>
<body>
    <h1>Weather in <?php echo $city; ?></h1>
    <?php if (isset($temperature)): ?>
        <p>Temperature: <?php echo $temperature; ?>°C</p>
        <p>Description: <?php echo ucfirst($description); ?></p>
        <img src="<?php echo $iconUrl; ?>" alt="Weather Icon">
    <?php else: ?>
        <p>Unable to fetch weather data.</p>
    <?php endif; ?>
</body>
</html>
