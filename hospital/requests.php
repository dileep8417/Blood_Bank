<?php

    /*                                                                                            
          
        This file is to display the requests made by the receivers to the blood bank                                                                                                          

    */


      require "../config/connection.php"; # For establishing databse connection
      require "../operations.php"; # contains methods for handling database and sessions

      # Restricting users other than hospital
      redirect_if_not_loggedin(); # Redirect to login page if the user accessing the page without login
      redirect_if_receiver(); # Redirects the receiver when accessing this page

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receivers Request</title>
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
    <link rel="stylesheet" href="../assets/css/req.css">
</head>
<body>
    <!-- Navbar -->
    <?php include "../components/navbar.php"?>

    <!-- Content -->
    <div class="container-fluid">
        <div class="row">
            <h4 class="text-danger">Receivers Requests</h4>
            <div id="requests">
                <!-- Receivers requests -->
                <?php include "../modules/requests_from_receiver.php"?>  
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <?php include "../components/footer.php"?>
</body>
</html>