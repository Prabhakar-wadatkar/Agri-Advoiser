<?php

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

            <!-- Add Farm Section -->
            <div class="dash-content">
                <div class="overview">
                    <div class="title">
                        <i class="uil uil-file-plus-alt "></i>
                        <span class="text">Add Farm details</span>
                    </div>
                    <div class="container">
                        <form id="farmForm" action="save_data.php" method="POST">
                            <div class="form-group">
                                <label for="farm_name">Farm Name:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="farm_name"
                                    name="farm_name"
                                    required="required">
                            </div>
                            <div class="form-group">
                                <label for="location">Location:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="location"
                                    name="location"
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
                                        required="required">
                                </div>
                                <div class="col">
                                    <label for="soil_type">Soil Type:</label>
                                    <select
                                        class="form-control"
                                        id="soil_type"
                                        name="soil_type"
                                        required="required">
                                        <option value="Black">Black</option>
                                        <option value="Clayey">Clayey</option>
                                        <option value="Loamy">Loamy</option>
                                        <option value="Red">Red</option>
                                        <option value="Sandy">Sandy</option>
                                        <!-- Add more soil type options as needed -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="crop_sowing_date">Crop Sowing Date:</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        id="crop_sowing_date"
                                        name="crop_sowing_date"
                                        required="required">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col">
                                    <label for="Climate">Climate Conditions:</label>
                                    <select class="form-control" id="Climate" name="Climate" required="required">
                                        <option value="Arid">Arid</option>
                                        <option value="Mediterranean">Mediterranean</option>
                                        <option value="Subtropical">Subtropical</option>
                                        <option value="Temperate">Temperate</option>
                                        <option value="Tropical">Tropical</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="annual_precipitation">Annual Precipitation (mm):</label>
                                    <div class="input-group mb-2">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="annual_precipitation"
                                            name="annual_precipitation"
                                            placeholder="Annual Precipitation"
                                            required="required">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">mm</div>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
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