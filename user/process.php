<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Get the user's username from the session
$username = $_SESSION['username'];

// Get form data
$crop_type = $_POST['crop_type'];
$location = $_POST['location'];
$area = floatval($_POST['area']); // Convert area to a float

// Connect to the database (replace with your database credentials)
$db = new mysqli('localhost', 'username', 'password', 'crop_data');

// Check for database connection errors
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Get the user's ID from the database
$query = "SELECT id FROM users WHERE username = '$username'";
$result = $db->query($query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['id'];
} else {
    die("User not found in the database.");
}

// Insert data into the crop_information table
$insert_query = "INSERT INTO crop_information (user_id, crop_type, location, area) VALUES ($user_id, '$crop_type', '$location', $area)";

if ($db->query($insert_query) === TRUE) {
    echo "Data inserted successfully!";
} else {
    echo "Error: " . $insert_query . "<br>" . $db->error;
}

// Close the database connection
$db->close();
?>
