<?php
    
    # This file is to handle the hospital registrtion form submission

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        require "../config/connection.php"; # contains database connection
        require "../operations.php"; # contains methods for handling database

        # Fetch and store the form data
        # Sanitize the data 
        $hospital_name = filter_var($_POST['hospital'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
        $contact = filter_var($_POST['contact'], FILTER_SANITIZE_STRING);
        $state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);
        $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
        $zipcode = filter_var($_POST['zipcode'], FILTER_SANITIZE_STRING);
        $pwd = md5($_POST['pwd']);         # Using md5 encrytion for encrypting the password
        $type = "H";                       # Categorizes the users as hospital
        
        # Check email exist or not
        # If not exist register the user
        if(!is_email_exist($conn,$email)){          # Returns user id if email exist else false
            $user_id = register($conn,$email,$pwd,$type);  # Registers the user and returns user id of registered user
            if($user_id){
                # Insert the user details into the hospitals table 
                $insert_query = "INSERT INTO hospitals (user_id,hospital_name,state,city,zipcode,contact_no)
                VALUES('$user_id','$hospital_name','$state','$city','$zipcode','$contact')";
                $result = mysqli_query($conn,$insert_query);        # Executes query
                if($result){
                    #echo "Registered successfully...";
                    # Inserts data to blood_info table
                    # Get the hospital id of current registering user for referencing in blood_info table
                    $query = "SELECT id FROM hospitals WHERE user_id='$user_id' LIMIT 1";
                    $result = mysqli_query($conn,$query);
                    $hospital_id = mysqli_fetch_assoc($result)["id"];

                    # array to store blood groups
                    $blood_groups = array("A+","A-","B+","B-","AB+","AB-","O+","O-");

                    # Insert the blood group data in the blood_info table by iterating through loop 
                    #for setting all the blood groups details
                    foreach($blood_groups as $grp){
                        $query = "INSERT INTO blood_info(hospital_id,blood_group,qnt) VALUES ('$hospital_id','$grp',0)";
                        mysqli_query($conn,$query);
                    }
                    # Redirect user to login page on completion of the registration
                    header("Location: ../authentication/login.php");
                }
            }
        }
        else{
            #echo "Email already exist !";
            header("Location: ../authentication/login.php?err=2"); # Redirects user to login page and displays error message
        }
    }

?>