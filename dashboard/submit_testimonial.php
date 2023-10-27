<?php
           include('../php/config.php');
           session_start();

// Check if the username is set in the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = ''; // Default value if username is not set in the session
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $username = $_POST['username'];
    $testimonialText = $_POST['testimonial'];
    $rating = $_POST['rating'];

    // Validate and sanitize the data (you can add more validation as needed)
    $username = htmlspecialchars($username);
    $testimonialText = htmlspecialchars($testimonialText);



    // Prepare and execute the SQL query to insert data into the database
    $sql = "INSERT INTO testimonials (username, testimonial_text, rating) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("ssi", $username, $testimonialText, $rating);

    if ($stmt->execute()) {
        // Data inserted successfully
        echo "Testimonial submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Include Bootstrap CSS and Font Awesome CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-KyZXEAg3QhqLMpG8r+XpaF5l/XtsSf5+8D2U5CAv5W9fDE2hdXp5pXhWE3C0MMIn6"
            crossorigin="anonymous">
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
            rel="stylesheet">

        <!----======== CSS ======== -->

        <link rel="stylesheet" href="style.css">

        <!----===== Iconscout CSS ===== -->
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous">
        <link
            rel="stylesheet"
            href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

        <title>Agri Dashboard Panel</title>

    </head>
    <body>

        <style>
            /* Style the hidden radio button as a star icon */
            .star-rating input[type="radio"] {
                display: none;
            }

            .star-rating label {
                font-size: 30px;
                cursor: pointer;
            }

            .star-rating input[type="radio"] + label::before {
                content: "\f005";
                /* Unicode character for a solid star from Font Awesome */
                font-family: FontAwesome;
                color: #ccc;
            }

            .star-rating input[type="radio"]:checked + label::before {
                color: #ffc107;
                /* Change color for the checked star */
            }
            /* Reverse the order of stars */
            .star-rating {
                direction: rtl;
            }

            .star-rating input[type="radio"]:checked + label::before,
            .star-rating input[type="radio"]:checked + label ~ label::before {
                color: #ffc107;
                /* Change color for the checked star and all previous stars */
            }
        </style>

        <nav>
            <div class="logo-name">
                <img
                    src="../img/logo.png"
                    alt="Agri Advisor Logo"
                    style="max-height: 60px; padding-bottam: 5px; ">
            </div>

            <div class="menu-items">
                <ul class="nav-links">
                    <li>
                        <a href="index.php">
                            <i class="uil uil-estate"></i>
                            <span class="link-name">Dahsboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="weather.php">
                            <i class="uil uil-cloud-sun"></i>
                            <span class="link-name">Weather</span>
                        </a>
                    </li>
                    <li>
                        <a href="farms.php">
                            <i class="uil uil-files-landscapes"></i>
                            <span class="link-name">Farms</span>
                        </a>
                    </li>
                    <li>
                        <a href="add_farms.php">
                            <i class="uil uil-file-plus-alt"></i>
                            <span class="link-name">Add Farm</span>
                        </a>
                    </li>
                    <li>
                        <a href="crops.php">
                            <i class="uil uil-pagelines"></i>
                            <span class="link-name">Crops Rec</span>
                        </a>
                    </li>
                    <li>
                        <a href="fertilizer.php">
                            <i class="uil uil-chart"></i>
                            <span class="link-name">Fertilizer info</span>
                        </a>
                    </li>
                    <li>
                        <a href="user_profile.php">
                            <i class="uil uil-user"></i>
                            <span class="link-name">User Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="submit_testimonial.php">
                            <i class="uil uil-feedback"></i>
                            <span class="link-name">Feedback US</span>
                        </a>
                    </li>
                </ul>
                <ul class="logout-mode">

                    <li>
                        <a href="../php/logout.php" class="link-name">
                            <i class="uil uil-signout"></i>
                            <span class="link-name">Logout</span></a>

                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">

        <div class="dash-content">

            <!-- Display farm_info section -->
            <div class="title">
                <i class="uil-feedback"></i>
                <span class="text">Submit Feedback</span>
            </div>
            <div class="container">

                <div class="activity">
                    <div class="activity-data">
                        <form method="post" action="submit_testimonial.php">
                            <div class="mb-3">
                                <label for="username" class="form-label">Your Name:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="username"
                                    name="username"
                                    value="<?php echo $username; ?>"
                                    required="required">
                            </div>

                            <div class="mb-3">
                                <label for="testimonial" class="form-label">Write Your Review</label>
                                <textarea
                                    class="form-control"
                                    id="testimonial"
                                    name="testimonial"
                                    rows="4"
                                    required="required"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Rating:</label>
                                <div class="star-rating">
                                    <input type="radio" name="rating" value="5" id="star1">
                                    <label for="star1"></label>
                                    <input type="radio" name="rating" value="4" id="star2">
                                    <label for="star2"></label>
                                    <input type="radio" name="rating" value="3" id="star3">
                                    <label for="star3"></label>
                                    <input type="radio" name="rating" value="2" id="star4">
                                    <label for="star4"></label>
                                    <input type="radio" name="rating" value="1" id="star5">
                                    <label for="star5"></label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <!----======== icons ======== -->

    <script src="https://kit.fontawesome.com/a75cb9b5b7.js" crossorigin="anonymous"></script>
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
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>