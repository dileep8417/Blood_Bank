<?php
    
    /*
    
        This file is to register both the users after verifying the data 
    
    */
 

    require "../operations.php"; # contains methods for handling database and sessions
    
    redirect_if_loggedin() # redirect to actual page if the user loggedin

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
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

    <?php
        # Loading the registration form according to the URL request
        if(isset($_GET['category'])){
            if($_GET['category']=="receiver"){
                # Receiver Registration Form
                include "../templates/receiver-registration-form.html";
            }else if($_GET['category']=="hospital"){
                # Hospital Registration Form
                include "../templates/hospital-registration-form.html";
            }else{
                header("Location ../index.php");    # Redirects the user to home page if the url is invaid
            }
        }else{
            header("Location ../index.php");    # Redirects the user to home page if the url is invaid
        }
    ?>

    <!-- Footer -->
    <?php include "../components/footer.php"?>

   <!-- JS -->
   <script src="../assets/js/validate.js"></script>
</body>
</html>