<?php
// Include database connection code here
include('../php/config.php');           
session_start();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

        <div class="container">

            <div class="dash-content">

<!-- Profile section-->
            <?php
// Include your database connection code here

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
                <div class="activity">
                    <div class="title justify-content-center">
                        <i class="uil uil-user"></i>
                        <span class="text ">Profile</span>

                    </div>

                    <div class="card-body">
                        <form action="user_profile.php" method="POST">
                            <input type="hidden" name="farm_id" value="<?php echo $farm_id; ?>">
                            <div class="form-group">
                                <label for="farm_name">User Name:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="username"
                                    name="username"
                                    value="<?php echo isset($username) ? $username : ''; ?>"
                                    required="required">
                            </div>
                            <div class="form-group">
                                <label for="location">Location:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="location"
                                    name="location"
                                    value="<?php echo isset($location) ? $location : ''; ?>"
                                    required="required">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="area">Area (in acres):</label>
                                    <input
                                        type="number"
                                        step="0.01"
                                        class="form-control"
                                        id="area"
                                        name="area"
                                        value="<?php echo isset($area) ? $area : ''; ?>"
                                        required="required">
                                </div>
                                <div class="col">
                                    <label for="soil_type">Soil Type:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="soil_type"
                                        name="soil_type"
                                        value="<?php echo isset($soil_type) ? $soil_type : ''; ?>"
                                        required="required">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col">
                                    <label for="Climate">Climate Conditions:</label>
                                    <select class="form-control" id="Climate" name="Climate" required="required">
                                        <option
                                            value="Arid"
                                            <?php echo (isset($climate) && $climate === 'Arid') ? 'selected' : ''; ?>>Arid</option>
                                        <option
                                            value="Mediterranean"
                                            <?php echo (isset($climate) && $climate === 'Mediterranean') ? 'selected' : ''; ?>>Mediterranean</option>
                                        <option
                                            value="Subtropical"
                                            <?php echo (isset($climate) && $climate === 'Subtropical') ? 'selected' : ''; ?>>Subtropical</option>
                                        <option
                                            value="Temperate"
                                            <?php echo (isset($climate) && $climate === 'Temperate') ? 'selected' : ''; ?>>Temperate</option>
                                        <option
                                            value="Tropical"
                                            <?php echo (isset($climate) && $climate === 'Tropical') ? 'selected' : ''; ?>>Tropical</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="crop_sowing_date">Crop Sowing Date
                                    </label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        id="crop_sowing_date"
                                        name="crop_sowing_date"
                                        value="<?php echo isset($crop_sowing_date) ? $crop_sowing_date : ''; ?>"
                                        required="required">
                                </div>
                            </div><br>
                            <!-- <button type="submit" class="btn btn-primary">Update</button> <a
                            href="index.php" class="btn btn-secondary">Cancel</a> -->
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