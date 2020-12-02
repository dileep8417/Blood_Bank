<?php

    /*
    
        This module is to display the hospitals, bloood samples, recipients count on login page 
    
    */                                                                                           
                                                                                          

?>

<div id="live-data">
    <div class="frame">
        <p class="title">Hospitals</p>
        <p class="count"><?php echo get_count($conn,"hospitals")?></p>   
    </div>
    <div class="frame">
        <p class="title">Blood Samples</p>
        <p class="count"><?php echo get_total_blood_units($conn);?></p>
    </div>
    <div class="frame">
        <p class="title">Recipients</p>
        <p class="count"><?php echo get_all_requests_count($conn);?></p>
    </div>
</div>