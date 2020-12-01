<?php 

    ##########################################################################################
    #                                                                                        #
    #         This file contains the code for displaying all the available hospitals         #                                                                               
    #         and blood samples related information to the users                             #                                                                              
    #                                                                                        #
    ##########################################################################################


    require "./config/connection.php"; # For establishing databse connection
    require "./operations.php"; # contains methods for handling database and sessions

    # To display alert message on screen after receiver sents request to hospital
    if(isset($_SESSION['success'])){
        unset($_SESSION['success']);
        alert("Your request sent successfully."); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Samples</title>
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
    <link rel="stylesheet" href="./assets/css/bloodsamples.css">
    <!-- JS -->
    <script src="./assets/js/index.js"></script>
</head>
<body>
    <!-- Navbar -->
    <?php include "./components/navbar.php"?>

    <div class="container-fluid">
        <!-- To display the total amount of available units in each blood group -->
        <h4>Available Units</h4>
        <?php include "./modules/blood_samples_count.php"?>

        <!-- To display the hospital details and blood units avilable -->
        <h4>Hospitals Info</h4>
        <?php include "./modules/hospitals_data.php"?>

    </div>

    <!-- Footer -->
    <?php include "./components/footer.php"?>

     <!-- JS -->
     <script src="./assets/js/requests.js"></script>
</body>
</html>