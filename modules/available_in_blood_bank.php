<?php

    /*

        This module is used to display all the available units in each blood group       
         with in the blood bank   
    
    */

    $hospital_id = get_hospital_id(); # Returns hospital id of current user
?>

<table class="table" id="blood-qnt">
    <tr>
        <th>A+</th>
        <th>A-</th>
        <th>B+</th>
        <th>B-</th>
        <th>AB+</th>
        <th>AB-</th>
        <th>O+</th>
        <th>O-</th>
    </tr>
    <tr>
        <!-- Getting the count of each blood group from all the hospitals -->
        <th><?php echo get_available_qnt($conn,"A+",$hospital_id) # Returns available quantity in each group?></th>
        <th><?php echo get_available_qnt($conn,"A-",$hospital_id)?></th>
        <th><?php echo get_available_qnt($conn,"B+",$hospital_id)?></th>
        <th><?php echo get_available_qnt($conn,"B-",$hospital_id)?></th>
        <th><?php echo get_available_qnt($conn,"AB+",$hospital_id)?></th>
        <th><?php echo get_available_qnt($conn,"AB-",$hospital_id)?></th>
        <th><?php echo get_available_qnt($conn,"O+",$hospital_id)?></th>
        <th><?php echo get_available_qnt($conn,"O-",$hospital_id)?></th>
    </tr>
</table>