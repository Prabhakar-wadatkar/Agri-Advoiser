<?php
session_start();
// Database connection parameters

include 'config.php';

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("../dashboard/index.php");
}

if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM user_info WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
        header("Location: ../dashboard/index.php");
	} else {
		echo "<script>
                alert('Woops! Email or Password is Wrong.');
                window.location.href = '../index.php'; // Replace 'index.php' with the actual URL of your index page
              </script>";
		
	}
}

// Close the database connection
$conn->close();
?>