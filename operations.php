<?php

    /*                                                                                                   
            This is the core file of the application, it contains the necessary functions to                                                                                
            perform database and session related operations.                                   
                                                                                               
    */
    

    @session_start();

    # If you are running in localhost mention the name of the project placed folder
    # EX: foldername/
    $PROJECT_FOLDER_NAME = "BloodBank/";     # For routing among the links
    
    $HOST = $_SERVER['HTTP_HOST']."/$PROJECT_FOLDER_NAME";      # For getting Domain name of the website

   
    # To get all the hospitals data for displaying blood availability and quantity to users
    # Returns an associative array that contans hospitals and blood sample count data
    function get_all_blood_samples($conn){
        # To get blood units and hospital data
        # Joining hospitals and blood_info table
        $FETCH_HOSPITAL_BLOOD_SAMPLES_COUNT_QUERY = "SELECT hospitals.id,hospital_name,hospitals.state,
        hospitals.city,hospitals.zipcode,hospitals.contact_no,blood_info.blood_group,qnt
        FROM 
        hospitals 
        RIGHT JOIN 
        blood_info 
        ON 
        hospitals.id=blood_info.hospital_id";                   
       
        $result = mysqli_query($conn,$FETCH_HOSPITAL_BLOOD_SAMPLES_COUNT_QUERY);    # Execute query
        $blood_sample_data = array();                   # Array to store the final data
        # Setting blood samples count and hospitals data into the array 
        while($row = mysqli_fetch_assoc($result)){
            # Checking key exists or not
            # If not exists create
            if(!array_key_exists($row["id"],$blood_sample_data)){
                $blood_sample_data[$row['id']] = array("hospital_name"=>"",
                "hospital_id"=>"",
                "location"=>"",
                "A+"=>0,"A-"=>0,"B+"=>0,"B-"=>0,"AB+"=>0,"AB-"=>0,"O+"=>0,"O-"=>0);        
            }
            # Setting the hospital data along with its blood availability 
            if($row['blood_group']=="A+"){
                $blood_sample_data[$row["id"]]["A+"] = $row["qnt"];
            }else if($row['blood_group']=="A-"){
                $blood_sample_data[$row["id"]]["A-"] = $row["qnt"];
            }
            else if($row['blood_group']=="B+"){
                $blood_sample_data[$row["id"]]["B+"] = $row["qnt"];
            }
            else if($row['blood_group']=="B-"){
                $blood_sample_data[$row["id"]]["B-"] = $row["qnt"];
            }
            else if($row['blood_group']=="AB+"){
                $blood_sample_data[$row["id"]]["AB+"] = $row["qnt"];
            }
            else if($row['blood_group']=="AB-"){
                $blood_sample_data[$row["id"]]["AB-"] = $row["qnt"];
            }
            else if($row['blood_group']=="O+"){
                $blood_sample_data[$row["id"]]["O-"] = $row["qnt"];
            }
            else if($row['blood_group']=="O-"){
                $blood_sample_data[$row["id"]]["O-"] = $row["qnt"];
            }
            $blood_sample_data[$row["id"]]["hospital_id"] = $row["id"]; 
            $blood_sample_data[$row["id"]]["hospital_name"] = $row["hospital_name"];
            $blood_sample_data[$row["id"]]["location"] = $row["city"].",".$row["state"]."-".$row["zipcode"];
        }
        return $blood_sample_data;   # Contains hospitals and blood sample count data
    }



    # To check whether email Id exist or not
    # Returns `user id` if email exist else `false`
    function is_email_exist($conn,$email){
        # Fetch user id from users table using email id
        $FETCH_USER_ID = "SELECT id from users WHERE email='$email'";
        $result = mysqli_query($conn,$FETCH_USER_ID);
        if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
            return $row['id'];      # returns the user id
        }
        return false;   # if registration fails
    }
    

    # For registering the users into the application
    # Returns `user id` if registration completed else `false`
    function register($conn,$email,$pwd,$type){
        # Add the user credentials into users table
        $INSERT_USER_CREDENTIALS_QUERY = "INSERT INTO users (email,password,type) VALUES('$email','$pwd','$type')";
        $result = mysqli_query($conn,$INSERT_USER_CREDENTIALS_QUERY);
        if($result){
            return is_email_exist($conn,$email);  # For returning the user id 
        }
        return false;
    }


    # To login the user and creates required sessions
    # Returns boolean value
    function login($conn,$email,$pwd){
        $USER_LOGIN_QUERY = "SELECT id,type from users WHERE email='$email' AND password='$pwd'";
        $result = mysqli_query($conn,$USER_LOGIN_QUERY);
        if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);     # Returns an associative array contains data from the selected table
            # Setting sessions
            $_SESSION['id'] = $row['id'];
            $uid = $row['id'];
            $_SESSION['email'] = $email;
            $_SESSION['type'] = $row['type'];
            if($row['type']=="H"){
                # Fetching hospital details if the user is hospital
                $FETCH_USER_HOSPITAL_QUERY = "SELECT * FROM hospitals WHERE user_id='$uid'";
                $result = mysqli_query($conn,$FETCH_USER_HOSPITAL_QUERY);
                $hospital_data = mysqli_fetch_assoc($result);
                # Setting sessions for hospital
                $_SESSION['hospital_name'] = $hospital_data["hospital_name"];
                $_SESSION['hospital_id'] =  $hospital_data["id"];
            }else{
                # Fetching receiver details if the user is receiver
                $FETCH_RECEIVER_BLOOD_GROUP_QUERY = "SELECT blood_group FROM receiver_details WHERE user_id='$uid'";
                $result = mysqli_query($conn,$FETCH_RECEIVER_BLOOD_GROUP_QUERY);
                $_SESSION['blood_group'] = mysqli_fetch_assoc($result)["blood_group"];
            }
            return true;      # on completion of login
        }
        return false;       # on failure on login
    }



    # For sending Request to hospital for blood sample
    # Returns true if request sent else false
    function send_request($conn,$hospital_id,$blood_group,$quantity,$msg){
        $user_id = get_user_id();       # To get current receiver user id
        # Insert requested data into user_requests
        $query = "INSERT INTO user_requests (user_id,hospital_id,blood_group,qnt,msg)
        VALUES ('$user_id','$hospital_id','$blood_group','$quantity','$msg')";

        $result = mysqli_query($conn,$query);
        
        if($result){
            return true;
        }
        return false;
    }



    # To fetch requests of the users for displaying to the hospital/blood bank
    # Returns an associative array of receiver requests
    function get_receiver_requests($conn){
        $hospital_id = get_hospital_id();
        # Query to fetch requested receivers details
        $FETCH_RECEIVERS_REQUEST_QUERY = "SELECT receiver.user_name,receiver.blood_group AS bg,receiver.age,
        receiver.state,receiver.city,receiver.zipcode,receiver.contact_no,req.id,req.blood_group AS req_bg,qnt,msg,req.req_time
        FROM receiver_details AS receiver 
        JOIN user_requests AS req 
        ON receiver.user_id=req.user_id AND req.hospital_id='$hospital_id' ORDER BY req.id DESC"; 

        $result = mysqli_query($conn,$FETCH_RECEIVERS_REQUEST_QUERY);   # To execute the query
        
        $receivers_data = array();              # To store final result            
        
        # Setting the data to the array
        while($row=mysqli_fetch_assoc($result)){
            # Check whether key exist or not 
            # If not create
            if(!array_key_exists($row["id"],$receivers_data)){
                $receivers_data[$row["id"]] = array();            
            }
            $receivers_data[$row["id"]]["name"] = $row["user_name"];
            $receivers_data[$row["id"]]["age"] = $row["age"];
            $receivers_data[$row["id"]]["receiver_bg"] = $row["bg"];
            $receivers_data[$row["id"]]["city"] = $row["city"];
            $receivers_data[$row["id"]]["state"] = $row["state"];
            $receivers_data[$row["id"]]["zipcode"] = $row["zipcode"];
            $receivers_data[$row["id"]]["contact"] = $row["contact_no"];
            $receivers_data[$row["id"]]["msg"] = $row["msg"];
            $receivers_data[$row["id"]]["req_bg"] = $row["req_bg"];
            $receivers_data[$row["id"]]["time"] = $row["req_time"];
            $receivers_data[$row["id"]]["qnt"] = $row["qnt"];
        }
        return $receivers_data;
    }



    # Used to update the blood information in a blood bank
    function update_blood_qnt($conn,$grp,$qnt,$action){
        $hospital_id = get_hospital_id();
        # Get available quantity of the blood group in the hospital
        $val = get_available_qnt($conn,$grp,$hospital_id);
        if($action=="inc"){     # If increment add the value
            $val += $qnt;
        }else{
            $val -= $qnt;       # else decrement the value
        }
        if($val<0){             # if val is less than 0 set it to 0
            $val = 0;
        }
        $UPDATE_BLOOD_QNT_QUERY = "UPDATE blood_info SET qnt='$val' 
        WHERE hospital_id='$hospital_id' AND blood_group='$grp'";

        mysqli_query($conn,$UPDATE_BLOOD_QNT_QUERY);

        return true;
    }



    # For getting receivers requests in the blood bank
    function get_requests_count($conn){
        $hospital_id = get_hospital_id();
        $FETCH_REQUESTS_COUNT_QUERY = "SELECT COUNT(id) AS count FROM user_requests WHERE hospital_id='$hospital_id'";
        $result = mysqli_query($conn,$FETCH_REQUESTS_COUNT_QUERY);
        $count = mysqli_fetch_assoc($result)['count'];
        return $count;
    }



    # For getting all the receivers requests in the application
    function get_all_requests_count($conn){
        $FETCH_REQUESTS_COUNT_QUERY = "SELECT COUNT(id) AS count FROM user_requests";
        $result = mysqli_query($conn,$FETCH_REQUESTS_COUNT_QUERY);
        $count = mysqli_fetch_assoc($result)['count'];
        return $count;
    }



    # Returns available units of blood in each group with in the blood bank
    function get_available_qnt($conn,$blood_group,$hospital_id){
        $FETCH_BLOOD_QNT_QUERY = "SELECT qnt FROM blood_info WHERE hospital_id='$hospital_id' AND blood_group='$blood_group'";
        $result = mysqli_query($conn,$FETCH_BLOOD_QNT_QUERY);
        $count = mysqli_fetch_assoc($result)["qnt"];
        return $count;
    }

    

    # To check whether the user is loggedin or not
    # Returns boolean value
    function is_loggedin(){
        if(isset($_SESSION['id'])){
            return true;
        }
        return false;
    }


    # To restrict the access of loggedin users from accessing registration, login pages
    # Redirects to specific page
    function redirect_if_loggedin(){
        if(is_loggedin()){              # Check user loggedin or not
            global $HOST;
            if(get_user_type()=="H"){
                # If hospital
                header("Location: http://$HOST"."hospital/addbloodinfo.php");
            }else{
                # If receiver
                header("Location: http://$HOST"."bloodsamples.php");
            }
        }
    }


    # To restrict guest users from accessing important pages
    # Redirects to specific page
    function redirect_if_not_loggedin(){
        if(!is_loggedin()){
            global $HOST;
            header("Location: http://$HOST"."authentication/login.php");
        }
    }


    # To restrict receiver from accessing hospital user pages
    # Redirects to specific page
    function redirect_if_receiver(){
        global $HOST;
        if(get_user_id() && get_user_type()=="R"){
            header("Location: http://$HOST"."bloodsamples.php");
        }
    }


    # For getting hospital id of the current user
    # Returns hospital id
    function get_hospital_id(){
        return $_SESSION['hospital_id'];
    }


    # For getting user id of the current user
    # Returns user id
    function get_user_id(){
        return $_SESSION['id'];
    }


    # For getting blood group of receiver
    function get_blood_group(){
        if(isset($_SESSION['blood_group'])){
            return $_SESSION['blood_group'];
        }
        return false;
    }


    # Returns hospital name of current user
    function get_hospital_name(){
        return $_SESSION['hospital_name'];
    }


    # For getting the category of the current user [Receiver or Hospital]
    # Returns user type
    function get_user_type(){
        return $_SESSION['type'];
    }


    # To get the hospital details
    # Returns an array contains details of a hospital
    function get_hospital_details($conn,$hospital_id){
        $FETCH_HOSPITAL_DETAILS_QUERY = "SELECT * FROM hospitals WHERE id='$hospital_id'";
        $result = mysqli_query($conn,$FETCH_HOSPITAL_DETAILS_QUERY);
        $data = mysqli_fetch_assoc($result);
        return $data;
    }


    # To know the count of particular blood sample
    # Returns `count` of a available blood group
    function get_blood_sample_count($conn,$sample){
        $FETCH_BLOOD_GROUP_COUNT_QUERY = "SELECT SUM(qnt) AS count FROM blood_info WHERE blood_group='$sample'";
        $result = mysqli_query($conn,$FETCH_BLOOD_GROUP_COUNT_QUERY);
        $data = mysqli_fetch_assoc($result);
        if($data["count"]>0){
            return $data["count"];
        }
        return 0;
    }

    # Changes the blood group string format
    # aPos -> A+, aNeg -> A-
    function modify_blood_grp_val($blood_group){
        if($blood_group=="aPos"){
            return "A+";
         }if($blood_group=="bPos"){
            return "B+";
         }if($blood_group=="oPos"){
            return "O+";
         }if($blood_group=="abPos"){
            return "AB+";
         }if($blood_group=="aNeg"){
            return "A-";
         }if($blood_group=="bNeg"){
            return "B-";
         }if($blood_group=="oNeg"){
            return "O-";
         }if($blood_group=="abNeg"){
            return "AB-";
         }
    }


    
    # To find the count of a table
    # Returns `count` of a table
    function get_count($conn,$table){
        $FETCH_TABLE_COUNT_QUERY = "SELECT COUNT(id) AS count FROM $table";
        $result = mysqli_query($conn,$FETCH_TABLE_COUNT_QUERY);
        $data = mysqli_fetch_assoc($result);
        return $data["count"];
    }
    


    # Returns total number of available blood units from all the available blood banks
    function get_total_blood_units($conn){
        $FETCH_ALL_BLOOD_UNITS_COUNT_QUERY = "SELECT SUM(qnt) AS count FROM blood_info";
        $result = mysqli_query($conn,$FETCH_ALL_BLOOD_UNITS_COUNT_QUERY);
        $count =  mysqli_fetch_assoc($result)["count"];
        if($count>0){
            return $count;
        }
        return 0;
    }


    # Returns current page file name
    function get_current_path_name(){
        return explode(".",basename($_SERVER['PHP_SELF']))[0];
    }


    # Shows alert messages
    function alert($msg){
        ?>
        <script>alert("<?php echo $msg?>")</script>
        <?php
    }
?>