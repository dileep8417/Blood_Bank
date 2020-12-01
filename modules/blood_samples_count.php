<?php

    ###########################################################################################
    #                                                                                         #
    #    This module is to display the total blood units availability in each blood group     #
    #                                                                                         #
    ###########################################################################################

?>
<div id="available-blood-samples-count-frame">
    <div class="frame">
        <p class="sample-type">A+</p>
        <hr>
        <p class="sample-count"><?php echo get_blood_sample_count($conn,"A+")?></p>
    </div>
    <div class="frame">
        <p class="sample-type">A-</p>
        <hr> 
        <p class="sample-count"><?php echo get_blood_sample_count($conn,"A-")?></p>
    </div>
    <div class="frame">
        <p class="sample-type">B+</p>
        <hr> 
        <p class="sample-count"><?php echo get_blood_sample_count($conn,"B+")?></p>
    </div>
    <div class="frame">
        <p class="sample-type">B-</p>
        <hr> 
        <p class="sample-count"><?php echo get_blood_sample_count($conn,"B-")?></p>
    </div>
    <div class="frame">
        <p class="sample-type">AB+</p>
        <hr>
        <p class="sample-count"><?php echo get_blood_sample_count($conn,"AB+")?></p>
    </div>
    <div class="frame">
        <p class="sample-type">AB-</p>
        <hr>
        <p class="sample-count"><?php echo get_blood_sample_count($conn,"AB-")?></p>
    </div>
    <div class="frame">
        <p class="sample-type">O+</p>
        <hr> 
        <p class="sample-count"><?php echo get_blood_sample_count($conn,"O+")?></p>
    </div>
    <div class="frame">
        <p class="sample-type">O-</p>
        <hr>
        <p class="sample-count"><?php echo get_blood_sample_count($conn,"O-")?></p>
    </div>
</div>