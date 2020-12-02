<?php

/*

    * This project contains the code for Blood Bank Management System 

    * This file contains code for displaying information about the project and links to 
      access the features of the project               

*/


    require "./config/connection.php";   # For establishing databse connection
    require "./operations.php";          # contains methods for handling database and sessions

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saver-Blood Bank System</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Css -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/mainpage.css">
    <link rel="stylesheet" href="./assets/css/navbar.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <!-- JS -->
    <script src="./assets/js/index.js"></script>
</head>
<body>

    <!-- For showing loading progress on page -->
    <div id="loader"></div>

        <!-- Navbar -->
        <?php include "./components/navbar.php"?>

    <div class="container" id="body">
        <!-- About -->
        <p id="about">
            <span class="big-letter">S</span>aver is a blood banking system for helping the people who are in urgent of blood, by sending the receivers request to the available Blood Banks.
        </p>

        <!-- Available donors link -->
        <b>Are you in search for blood-<a href="./bloodsamples.php" class="available-donors-link">Check&nbsp;Available&nbsp;Blood&nbsp;Samples-></a></b>
        <p>
        At present we are with
        </p>
        
        <!-- Live count -->
        <?php include "./modules/data_count.php"?>

        <!-- Registration Links -->
        <p class="registration-heading">Register with us</p>
        <div class="reg">
            <a href="./authentication/registration.php?category=hospital"><button class="link-btn hospital-reg-link btn">For Hospitals</button></a>
            <a href="./authentication/registration.php?category=receiver"><button class="link-btn receivers-reg-link btn">For Receivers</button></a>
        </div>
        
        <!-- Note -->
        <div class="note">
            <p>
            <b>Note:</b>
            To donate blood or platelets, you must be in good general health, weigh at least 110 pounds,
            and be at least 16 years old.
            </p>
        </div>
        
    </div>


    <!-- footer -->
    <?php include "./components/footer.php"?>

</body>
</html>