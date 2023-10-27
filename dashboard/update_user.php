<?php

// Include database connection code here
include('../php/config.php');

// Check if the user is logged in (assuming you have a user session)
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // SQL query to retrieve user data from user_info table
    $userQuery = "SELECT address FROM user_info WHERE username = '$username'";
    $userResult = $conn->query($userQuery);

    if ($userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();
        $address = $userRow['address'];

        // SQL query to retrieve farm data from farm_info table
        $farmQuery = "SELECT username, farm_name, location, area, soil_type, climate, crop_sowing_date FROM farm_info WHERE username = '$username'";
        $farmResult = $conn->query($farmQuery);

        if ($farmResult->num_rows > 0) {
            $farmRow = $farmResult->fetch_assoc();
            $username = $farmRow['username'];
            $location = $farmRow['location'];
            $area = $farmRow['area'];
            $soil_type = $farmRow['soil_type'];
            $climate = $farmRow['climate'];
            $crop_sowing_date = $farmRow['crop_sowing_date'];
        }
    }
} else {
    // Redirect to login page or handle the case when the user is not logged in
}
?>
