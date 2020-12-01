<?php

    # This file is to handle the receiver registration form submision
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require "../config/connection.php"; # contains database connection
        require "../operations.php"; # contains methods for handling database

        # Fetch and store the form data
        # Sanitize the data 
        $user_name = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
        $age = filter_var($_POST['age'], FILTER_SANITIZE_STRING);
        $blood_group = filter_var($_POST['bloodgroup'], FILTER_SANITIZE_STRING);
        $contact = filter_var($_POST['contact'], FILTER_SANITIZE_STRING);
        $state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);
        $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
        $zipcode = filter_var($_POST['zipcode'], FILTER_SANITIZE_STRING);
        $pwd = md5($_POST['pwd']);
        $type = "R";                   # Categorizes the users as receiver

        # Check email exist or not
        # If not exist register the user
        if(!is_email_exist($conn,$email)){                  # returns user id if email exist 
            $user_id = register($conn,$email,$pwd,$type);   # returns user id of registered user
            if($user_id){
                # Insert the user details in receiver_details table
                $insert_query = "INSERT INTO receiver_details (user_id,user_name,blood_group,age,state,city,zipcode,contact_no)
                VALUES('$user_id','$user_name','$blood_group','$age','$state','$city','$zipcode','$contact')";
                $result = mysqli_query($conn,$insert_query);
                if($result){
                    echo "Registered successfully...";
                    # Redirects to login page after completion of registration
                    header("Location: ../authentication/login.php");    
                }
            }
        }else{
            echo "Email already exist !";
            header("Location: ../authentication/login.php?err=2");      # Redirects to login page and shows error message
        }
    }

?>