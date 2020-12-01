<?php

    ###############################################################################################
    #                                                                                             # 
    #     This file is to show the blood availability in the blood bank to the hospital user and  #
    #     allows to update the blood quantity information                                         #
    #                                                                                             #
    ###############################################################################################
    
    
    require "../config/connection.php";     # To establish database connection
    require "../operations.php";            # To access funtion for handling database and sessions

    # Restricting users other than hospital
    redirect_if_not_loggedin(); # Redirect to login page if the user accessing the page without login
    redirect_if_receiver(); # Redirects the receiver when accessing this page

    # To handle Form Submission
    if($_SERVER["REQUEST_METHOD"]=='POST'){
        $grp = $_POST["bloodgroup"];
        $qnt = $_POST["qnt"];
        $action = $_POST["action"];
        $res = update_blood_qnt($conn,$grp,$qnt,$action);
        if($res){
            alert("Details updated.");
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Blood Information</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Css -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>
     
    <!-- Navbar -->
    <?php include "../components/navbar.php"?>
    
    <div class="container">
        <h4 style="font-weight:bold">Welcome, <?php echo get_hospital_name()?></h4>
        <br>
           <!-- Show request count -->
           <div id="live-data">
            <div class="frame">
                <h4 class="">Total Requests</h4>
                <p class="count"><?php echo get_requests_count($conn);?></p>
               
                <!-- View Receivers Request Link-->
                <b style="display:block;text-align:center;margin-top:-20px"><a class="reg-links text-primary" style="font-size:22px" href="./requests.php">View&nbsp;Requests&nbsp;-></a></b>
            </div>
        </div>

        
        <h4>Available in Blood Bank</h4>

        <!-- Show Available Quantity in the blood bank -->
        <?php include "../modules/available_in_blood_bank.php"?>
        <br>
        <hr>

        <h5 class="text-danger mt-3 text-center" style="font-weight:bold">Update Blood Information</h5>
        <div id="err" class="text-danger"></div>

         <!-- Blood info update form -->
         <form action="<?php echo htmlentities($_SERVER["PHP_SELF"])?>" id="blood-info-form" method="POST">
            <?php include "../templates/blood-info-update-form.html"?>
        </form>

    </div>
   
    <!-- Footer -->
   <?php include "../components/footer.php"?>

   <!-- JS -->
   <script src="../assets/js/validate.js"></script>
</body>
</html>