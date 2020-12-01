<?php

    # This file is to handle the login form submision

    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
        require "../config/connection.php"; # contains database connection
        require "../operations.php"; # contains methods for handling database

        // Get form data
        $email = $_POST['email'];
        $pwd = md5($_POST['pwd']);

        $is_valid_details = login($conn,$email,$pwd); // creates sessions and returns boolean value

        if($is_valid_details){
            if($_SESSION['type']=='R'){
                header("Location: ../bloodsamples.php"); // if user is receiver redirect to available blood samples
            }else if($_SESSION['type']=='H'){
                header("Location: ../hospital/addbloodinfo.php"); // if user is hospital management redirect to hospital addbloodinfo
            }
        }else{
            header("Location: ../authentication/login.php?err=1"); // redirect to login page if credentials are invalid
        }
    }

?>