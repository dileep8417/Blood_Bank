<?php

        # This file is to display the navbar with links according to the user accessing page

?>

<nav class="navbar navbar-expand-md navbar-light">
    <!-- Logo -->
    <a class="navbar-brand logo" href="http://<?php echo $HOST?>">
        <p>Saver</p>
        <img src="http://<?php echo $HOST?>/assets/images/blood-drop.png" alt="">
    </a>
    <!-- Toogler Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
  <!--Navbar Links -->
  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav ml-auto">
        <li style="display:<?php echo get_current_path_name()=='index'?'none':''?>" class="nav-item">
                <a class="nav-link" href="http://<?php echo $HOST?>">Home</a>
        </li>
        <?php
            if(is_loggedin()){
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="http://<?php echo $HOST?>/authentication/logout.php">Logout</a>
                    </li>
                <?php
                    if(get_current_path_name()=="index" && get_user_type()=="H"){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="http://<?php echo $HOST?>/hospital/addbloodinfo.php">Dashboard</a>
                        </li>
                        <?php
                    }
                    else if(get_current_path_name()=="addbloodinfo"){
                        ?>
                        <li class="nav-item">
                        <a class="nav-link" href="http://<?php echo $HOST?>/bloodsamples.php">Available Samples</a>
                        </li>
                        <?php
                    }
                    else if(get_current_path_name()=="bloodsamples" && get_user_type()=="H"){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="http://<?php echo $HOST?>/hospital/addbloodinfo.php">Dashboard</a>
                        </li>
                    <?php
                    }
                    else if(get_current_path_name()=="requests" && get_user_type()=="H"){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="http://<?php echo $HOST?>/hospital/addbloodinfo.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://<?php echo $HOST?>/bloodsamples.php">Available Samples</a>
                        </li>
                    <?php
                    }
                    else if(get_current_path_name()=="requestblood"){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="http://<?php echo $HOST?>/bloodsamples.php">Available Samples</a>
                        </li>
                        <?php
                    }
                    else if(get_current_path_name()=="adddonor"){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="http://<?php echo $HOST?>/bloodsamples.php">Available Samples</a>
                        </li>
                        <?php
                    }
            }else{
                if(get_current_path_name()=="login"){
                    ?>
                        <li class="nav-item">
                             <a class="nav-link h-reg" href="./registration.php?category=hospital">Hospital&nbsp;Registration&nbsp;-></a>
                        </li>
                        <li class="nav-item">
                             <a class="nav-link r-reg" href="./registration.php?category=receiver">Receiver&nbsp;Registration&nbsp;-></a>
                        </li>
                    <?php
                }else{
                    ?>   
                    <li class="nav-item">
                        <a class="nav-link" href="http://<?php echo $HOST?>/authentication/login.php">Login</a>
                    </li>
                    <?php
                }
        }
        ?>
    </ul>
  </div>
</nav>


    
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>