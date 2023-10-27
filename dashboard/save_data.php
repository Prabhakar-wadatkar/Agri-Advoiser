<?php

include('../php/config.php');
session_start(); 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $farm_name = $_POST['farm_name'];
    $location = $_POST['location'];
    $area = $_POST['area'];
    $soil_type = $_POST['soil_type'];
    $climate = $_POST['Climate'];
    $annual_precipitation = $_POST['annual_precipitation'];
    $crop_sowing_date = $_POST['crop_sowing_date']; // Added line to retrieve Crop Sowing Date

    // Retrieve username from the session
    $username = $_SESSION['username']; // Replace 'username' with the actual session variable name

    $sql = "INSERT INTO farm_info (username, farm_name, location, area, soil_type, climate, annual_precipitation, crop_sowing_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: " . mysqli_error($conn));
    }

    $stmt->bind_param("ssssssss", $username, $farm_name, $location, $area, $soil_type, $climate, $annual_precipitation, $crop_sowing_date);

    // Execute the statement and handle any errors if necessary
    if ($stmt->execute()) {
        // Farm data saved successfully
        echo "<script>
                alert('Farm data saved successfully.');
                window.location.href = 'index.php'; // Replace 'index.php' with the actual URL of your index page
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
