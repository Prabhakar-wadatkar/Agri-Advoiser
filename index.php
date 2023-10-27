<?php 

include './php/config.php';

session_start();

error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Agri Advisor</title>
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css"/>

        <!-- Unicons -->
        <link
            rel="stylesheet"
            href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"/>
        <!-- Include Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css"
            rel="stylesheet">

        <!-- Include Bootstrap JavaScript (Popper.js and Bootstrap JS) -->
        <script
            src="https://cdn.jsdelivr.net/npm/popper.js@2.11.6/dist/umd/popper.min.js"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.min.js"></script>

        <!-- Your custom CSS -->
        <style>
            .navbar-brand {
                font-size: 30px;
                /* Increase font size */
                font-family: 'Lora', serif;
            }

            .header {
                /* Your other header styles */
            }
        </style>
    </head>
    <body>

        <!-- Header -->
        <header class="header">
            <nav class="navbar navbar-expand-lg transparent">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img
                            src="img/logo.png"
                            alt="Agri Advisor Logo"
                            style="max-height: 60px; padding-bottam: 5px; ">
                    </a>
                    <button class="btn btn-primary" id="form-open">Login</button>
                </div>
            </nav>
        </header>

        <!-- Home -->
        <section class="home">
            <div class="container ">
                <div class="row" style="padding-top: 80px;">
                    <div class="col-sm-3">
                        <div class="card" style="background-color: rgba(255, 255, 255, 0.5)">
                            <div class="card-body d-flex flex-column">

                                <!-- Weather Information -->
                                <div class="d-flex">
                                    <h6 class="flex-grow-1" style="font-size: 0.7rem;" id="location-name">Loading...</h6>
                                    <h6 style="font-size: 0.7rem;" id="current-time"></h6>
                                </div>
                                <div class="d-flex align-items-center" style="width:25px,25px;">
                                    <h6
                                        class="display-4 mb-0 font-weight-bold"
                                        style="color: #1C2331; font-size: 1rem;">Loading...</h6>&nbsp;&nbsp;
                                    <span
                                        class="small"
                                        style="color: #868B94; font-size: 0.7rem;"
                                        id="weather-description">Fetching weather...</span>&nbsp;&nbsp;
                                    <div class="flex-grow-1" style="font-size: 0.6rem; " id="weather-details">
                                        <!-- Weather details will be updated here -->
                                    </div>
                                    <div>
                                        <img width="50px" id="weather-icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .card {
                    height: 100px;
                    width: 300px;
                }
            </style>

            <div class="form_container">
                <i class="uil uil-times form_close"></i>
                <!-- Login From -->

                <div class="form login_form">
                    <form action="./php/login.php" method="POST" class="login-email">
                        <h2>Login</h2>

                        <div class="input_box">
                            <input
                                type="email"
                                name="email"
                                placeholder="Enter your email"
                                required="required"/>
                            <i class="uil uil-envelope-alt email"></i>
                        </div>
                        <div class="input_box">
                            <input
                                type="password"
                                name="password"
                                placeholder="Enter your password"
                                required="required"/>
                            <i class="uil uil-lock password"></i>
                            <i class="uil uil-eye-slash pw_hide"></i>
                        </div>

                        <div class="option_field">
                            <span class="checkbox">
                                <input type="checkbox" id="check"/>
                                <label for="check">Remember me</label>
                            </span>
                            <a href="#" class="forgot_pw">Forgot password?</a>
                        </div>

                        <button name="login" class="button">Login Now</button>

                        <div class="login_signup">Don't have an account?
                            <a href="#" id="signup">Signup</a>
                        </div>
                    </form>
                </div>
                <!-- login Form closed-->

                <!-- Registration Form -->
            <?php 

if (isset($_SESSION['username'])) {
    header("Location: ../dashboard/index.php");
}

if (isset($_POST['register'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM user_info WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO user_info (username, email, password)
					VALUES ('$username', '$email', '$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Wow! User Registration Completed.')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
		}
		
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}

?>
                <div class="form signup_form">
                    <form action="#" method="POST">
                        <h2>Signup</h2>
                        <div class="input_box">
                            <i class="uil uil-user user"></i>
                            <input
                                type="text"
                                placeholder="Username"
                                name="username"
                                value="<?php echo $username; ?>"
                                required="required">
                        </div>

                        <div class="input_box">
                            <input
                                type="email"
                                placeholder="Enter your email"
                                name="email"
                                value="<?php echo $email; ?>"
                                required="required"/>
                            <i class="uil uil-envelope-alt email"></i>
                        </div>
                        <div class="input_box">
                            <input
                                type="password"
                                placeholder="Create password"
                                name="password"
                                value="<?php echo $_POST['password']; ?>"
                                required="required"/>
                            <i class="uil uil-lock password"></i>
                            <i class="uil uil-eye-slash pw_hide"></i>
                        </div>
                        <div class="input_box">
                            <input
                                type="password"
                                placeholder="Confirm password"
                                name="cpassword"
                                value="<?php echo $_POST['cpassword']; ?>"
                                required="required"/>
                            <i class="uil uil-lock password"></i>
                            <i class="uil uil-eye-slash pw_hide"></i>
                        </div>

                        <button class="button" name="register">Signup Now</button>

                        <div class="login_signup">Already have an account?
                            <a href="#" id="login">Login</a>
                        </div>
                    </form>
                </div>
                <!-- Registration Form closed-->
            </div>

            <!-- About Us Section -->
            <section id="about" class="py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <div
                                id="imageCarousel"
                                style="width: 100%; max-width: 400px; "
                                class="carousel slide"
                                data-ride="carousel">
                                <div class="carousel-inner center">
                                    <div class="carousel-item active">
                                        <img
                                            src="./img/3.jpeg"
                                            alt="Image 3"
                                            class="img-fluid"
                                            style="width: 100%; max-width: 400px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img
                                            src="./img/2.jpeg"
                                            alt="Image 2"
                                            class="img-fluid"
                                            style="width: 100%; max-width: 400px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img
                                            src="./img/3.jpeg"
                                            alt="Image 3"
                                            class="img-fluid"
                                            style="width: 100%; max-width: 400px;">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#imageCarousel" data-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </a>
                                <a class="carousel-control-next" href="#imageCarousel" data-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm text-white">
                            <h2 class="display-6 " style="color: black; text-shadow: 2px 2px 4px white;">Welcome to<br>
                                Agriculture Advisor</h2>
                            <!-- Set the text color to blue using inline CSS -->
                            <p style="color: black; text-shadow: 2px 2px 4px white;"></p>
                            <p style="color: black; text-shadow: 1px 1px 4px white;">Our mission is to
                                enhance agricultural practices, promote sustainability, and contribute to the
                                growth of the agriculture industry.</p>
                            <p style="color: black; text-shadow: 1px 1px 4px white;">"Our project provides
                                valuable insights for farmers, offering expert guidance on crop selection and
                                tailored fertilizer recommendations. With a team of seasoned agriculture
                                advisors, we empower individuals in the agriculture sector to make informed
                                decisions, optimize yields, and enhance sustainability."</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial section -->
                <div class="container">
                    <div class="row" style="padding-top: 10px;">
                        <h3
                            class="text-center text-white"
                            style="color: black; text-shadow: 2px 2px 4px black;">
                            Testimonial
                        </h3>

                    <?php

// SQL query to retrieve testimonials
$sql = "SELECT * FROM testimonials ORDER BY timestamp DESC LIMIT 4";
$result = $conn->query($sql);

$count = 0; // Initialize a count variable

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $testimonialText = $row["testimonial_text"];
        $username = $row["username"];
        $rating = $row["rating"]; // Assuming you have a 'rating' column

        // Add HTML code to display each testimonial in a new card
        echo '<div class="col-sm-3">';
        echo '<div class="card" style="background-color: rgba(255, 255, 255, 0.5)">';
        echo '<div class="card-body d-flex flex-column">';
        
       
        
        echo '<p " style="font-size: 10px;">' . $testimonialText .'<br>' ;
         // Display stars based on the rating
         for ($i = 1; $i <= $rating; $i++) {
             echo '<span class="star" >★</span>';
         }
         echo '<br>';
         echo '<span class="text-dark" style="font-size: 10px; text-shadow: 0.2px 0.2px  0.1px; black;" >- ' . $username . '</span>';
         echo '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        $count++;

        // Close the row and start a new row after displaying 4 cards
        if ($count % 4 == 0) {
            echo '</div>';
            echo '<div class="row" style="padding-top: 20px;">'; // Start a new row
        }
    }
} else {
    echo "No testimonials available.";
}

$conn->close();
?>

                    </div>

                </div>

            </section>

            <!-- Contact Us Section -->
            <!-- <section id="contact" class="py-5"> <div class="container"> <div
            class="row"> <div class="col-sm"> </div> <div class="col-lg-6 text-white "> <h2
            class="display-4 align-items-center">Contact Us</h2> <p class="lead">If you have
            any questions or inquiries, please feel free to contact us using the form
            below.</p> -->

            <!-- Contact Form -->
            <!-- <form action="process_form.php" method="post"> <div class="form-group">
            <label for="name">Name:</label> <input type="text" class="form-control"
            id="name" name="name" required> </div> <div class="form-group"> <label
            for="email">Email:</label> <input type="email" class="form-control" id="email"
            name="email" required> </div> <div class="form-group"> <label
            for="message">Message:</label> <textarea class="form-control" id="message"
            name="message" rows="5" required></textarea> </div> <button type="submit"
            class="btn btn-primary">Submit</button> </form> </div> <div class="col-sm">
            </div> </div> </div> </section> -->

            <footer
                class="text-dark fixed-bottom"
                style="background-color: rgba(255, 255, 255, 0.5);">
                <div class="container" style="padding: 10px 0 1px;">
                    <div class="row">
                        <div
                            class="col-lg-12 text-center text-dark"
                            style="font-size: 14px;  text-shadow: 0.2px 0.2px  0.2px; black;">
                            <p style="margin: 0.5px; color: black;">&copy; 2023 Agri Advisor | Designed and Developed by Shraddha & Shraddha</p>
                            <p style=" color: black; text-shadow: 0.5px 0.5px  0.2px black;">
                                <a href="#">Home</a>
                                |
                                <a href="#about">About</a>
                                |
                                <a href="#contact">Contact Us</a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>

        </section>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script/script.js"></script>
        <script src="script/weather.js"></script>
        <!-- Add Bootstrap JS and jQuery scripts here -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script
            src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    </body>
</html>