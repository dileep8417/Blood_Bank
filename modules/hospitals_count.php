<?php

    /*
    
        This module is to display the hospitals,bloood units,receivers count  
    
    */                                                                                           
                                                                                          

?>

<div id="live-data">
    <div class="frame">
        <p class="title">Hospitals</p>
        <p class="count"><?php echo get_count($conn,"hospitals")?></p>   
    </div>
    <div class="frame">
        <p class="title">Blood Units</p>
        <p class="count"><?php echo get_total_blood_units($conn);?></p>
    </div>
    <div class="frame">
        <p class="title">Recipients</p>
        <p class="count"><?php echo get_count($conn,"receiver_details");?></p>
    </div>
</div>