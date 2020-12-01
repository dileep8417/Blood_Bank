<?php

    ###########################################################################################
    #                                                                                         #
    #        This module is used to display all the available units in each blood group       #
    #        with in the blood bank                                                           #
    #                                                                                         #
    ###########################################################################################

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
        <th><?php echo get_available_qnt($conn,"A+")?></th>
        <th><?php echo get_available_qnt($conn,"A-")?></th>
        <th><?php echo get_available_qnt($conn,"B+")?></th>
        <th><?php echo get_available_qnt($conn,"B-")?></th>
        <th><?php echo get_available_qnt($conn,"AB+")?></th>
        <th><?php echo get_available_qnt($conn,"AB-")?></th>
        <th><?php echo get_available_qnt($conn,"O+")?></th>
        <th><?php echo get_available_qnt($conn,"O-")?></th>
    </tr>
</table>