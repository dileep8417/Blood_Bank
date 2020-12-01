<?php

    # To get count of particular blood sample in the blood bank before allowing receiver request
    
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        if(isset($_GET["id"])){
            require "./config/connection.php";   # For establishing databse connection
            require "./operations.php";          # contains methods for handling database and sessions
            # Storing the GET request data
            $hospital_id = $_GET["id"];
            $blood_group = $_GET["grp"];
            # Changing the value according to the convinience for storing in datbase
            # aPos -> A+, aNeg -> A-
            $blood_group = modify_blood_grp_val($blood_group);
            $count = get_available_qnt($conn,$blood_group,$hospital_id); # returns the number of units of mentioned blood group
            echo $count;
        }
    }


?>