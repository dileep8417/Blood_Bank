<?php

    /*

        This file is to login the user after validating the credentials             

    */                                                                                                                                                                                     


    require "../operations.php"; # contains functions for handling database and sessions
    
    redirect_if_loggedin() # redirect to actual page if the user is already loggedin
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/form.css">
</head>
<body>
    
    <!-- Navbar -->
    <?php include "../components/navbar.php"?>
   
    <!-- Error Notification -->
    <?php
        if(isset($_GET['err'])){
            if($_GET['err']==1){
                echo "<center>Invalid Credentials</center>";
            }else if($_GET['err']==2){
                echo "<center>Email already exist</center>";
            }
        }
    ?>
    <!-- Login Form -->
    <?php include "../templates/login.html"?>
    
    <!-- Footer -->
    <?php include "../components/footer.php"?>
</body>
</html>