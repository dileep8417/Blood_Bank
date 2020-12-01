<?php
    
    # Logouts the user by deleting all the sessions

    session_start();
    session_destroy();
    header("Location: ../index.php"); # Redirects the user to home page

?>