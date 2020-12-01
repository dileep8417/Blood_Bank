<?php

     /*                                                                                        
           This file contains the code to send request for the blood units to the            
           hospitals by the receiver.                                                        
                                                                                             
    */

    
    require "./config/connection.php";   # For establishing databse connection
    require "./operations.php";          # contains methods for handling database and sessions
    
    redirect_if_not_loggedin();         # Redirects user to destination page if not loggedin

    if(get_user_type()=="H"){           # Checks the type of the user for restricting hospital users to access this page
        redirect_if_loggedin();         # Redirects user to destination page if not loggedin
        die();                          # To stop loading of remaining page
    }

   if(isset($_GET['id'])){
        $hospital_id = $_GET['id'];
        # Get the information of the requesting hospital
        $hospital_data = get_hospital_details($conn,$hospital_id);
   }

    # For handling the form submission
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        # Send blood request to the hospital
        # Store blood quantities
        $a_pos = $_POST["apos"];
        $a_neg = $_POST["aneg"];
        $b_pos = $_POST["bpos"];
        $b_neg = $_POST["bneg"];
        $ab_pos = $_POST["abpos"];
        $ab_neg = $_POST["abneg"];
        $o_pos = $_POST["opos"];
        $o_neg = $_POST["oneg"];

        $msg = filter_var($_POST['msg'],FILTER_SANITIZE_STRING);
        $hospital_id = $_POST["hospitalid"];
        
        if(strlen($msg)<3){
            $msg = "N/A";           # If message is invalid
        }
        
        $_SESSION['success'] = 1;               # To intimate the receiver about the completion of process
        if($a_pos>0){
            send_request($conn,$hospital_id,"A+",$a_pos,$msg);   # To add receiver sent request to the user_requests table
        }
        if($a_neg>0){
            send_request($conn,$hospital_id,"A-",$a_neg,$msg);
        }
        if($b_pos>0){
            send_request($conn,$hospital_id,"B+",$b_pos,$msg);
        }
        if($b_neg>0){
            send_request($conn,$hospital_id,"B-",$b_neg,$msg);
        }
        if($ab_pos>0){
            send_request($conn,$hospital_id,"AB+",$ab_pos,$msg);
        }
        if($ab_neg>0){
            send_request($conn,$hospital_id,"AB-",$ab_neg,$msg);
        }
        if($o_pos>0){
            send_request($conn,$hospital_id,"O+",$o_pos,$msg);
        }
        if($o_neg>0){
            send_request($conn,$hospital_id,"O-",$o_neg,$msg);
        }
       header("Location: ./bloodsamples.php");      # Redirects the page on completion of request
       die();                                                 # To avoid unnecessary loading
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Sample</title>
     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Css -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/navbar.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="stylesheet" href="./assets/css/req.css">
</head>
<body>
    
    <!-- Navbar -->
    <?php include "./components/navbar.php"?>

    <div id="req-frame" class="container">
    <h4 class="text-danger">Request Blood Sample</h4>
    <div class="row">
        <div class="col-sm-12">
            <!-- Receiver Requesting hospital information -->
            <h4>Hospital Details</h4>
            <table class="table">
                <tr class="center">
                    <th>Hospital Name</th>                        
                    <th>Contact number</th>
                    <th>Address</th>
                </tr>
                <tr>
                    <td><?php echo $hospital_data['hospital_name']?></td>
                    <td><?php echo $hospital_data['contact_no']?></td>
                    <td><?php echo $hospital_data["city"].",".$hospital_data["state"]."-".$hospital_data["zipcode"];?></td>
                </tr>
            </table>
        </div>

        <!-- Blood Request Form -->
        <?php include "./templates/receiver-request-form.html"?>

        <!-- Message Field -->
        <div class="col-sm-5">
            <br>
            <h5 style="width:100vw" class="text-success">Want to tell something </h5>
            <textarea name="" id="msg" onkeyup="updateMsg()" placeholder="Type here...."></textarea>
            <button type="submit" class="btn btn-danger" onclick="validateRequest(<?php echo $hospital_id?>)" id="req-btn">Send Request</button>
        </div>

    </div>
</div>

    <!-- Footer -->
    <?php include "./components/footer.php"?>
   
    <!-- JS -->
    <script>
        let receiverBloodGroup = "<?php echo get_blood_group()?>"; // For storing receivers blood group
        let hospitalId = "<?php echo $hospital_id?>"
    </script>
   <script src="./assets/js/requests.js"></script>
</body>
</html>