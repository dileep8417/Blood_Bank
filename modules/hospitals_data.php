<?php 

    /*

        This module is to show the availble hospital details along with the blood units     
        availability and allows receiver to request hospital for blood  
    
    */
                                                                                                                  
    
    $data = get_all_blood_samples($conn); # For getting available blood samples 
   
    # If no data available
    if(count($data)==0){
        ?>
            <h4 class="text-center text-primary">Sorry,No Data Available</h4>
        <?php
    }
?>

<div style="display:<?php echo count($data)==0?'none':''?>" id="table-data-frame">
    <table class="table" id="blood-sample-data">
        <tr>
            <th>Hospital Name</th>
            <th>A+</th>
            <th>A-</th>
            <th>B+</th>
            <th>B-</th>
            <th>AB+</th>
            <th>AB-</th>
            <th>O+</th>
            <th>O-</th>
            <th>Location</th>
            <th>Request Blood</th>
        </tr>
        
        <?php
            # Setting data into the table
            foreach($data as $key => $value){
                    $h_id = $value['hospital_id'];
                    $h_name = $value['hospital_name'];
                    $a_pos = $value['A+'];
                    $a_neg = $value['A-'];
                    $b_pos = $value['B+'];
                    $b_neg = $value['B-'];
                    $ab_pos = $value['AB+'];
                    $ab_neg = $value['AB-'];
                    $o_pos = $value['O+'];
                    $o_neg = $value['O-'];
                ?>
                <tr>
                    <td><?php echo $h_name;?></td>
                    <td><?php echo $a_pos;?></td>
                    <td><?php echo $a_neg;?></td>
                    <td><?php echo $b_pos?></td>
                    <td><?php echo $b_neg?></td>
                    <td><?php echo $ab_pos?></td>
                    <td><?php echo $ab_neg;?></td>
                    <td><?php echo $o_pos;?></td>
                    <td><?php echo $o_neg?></td>
                    <td><?php echo $value['location'];?></td>
                    <?php
                        if(is_loggedin()){
                           if(get_user_type()=="R"){
                            ?>
                                <td><img src="./assets/images/send.svg" onclick='sendReq("<?php echo $h_id;?>")' class="req-icon" alt=""></td>
                            <?php
                           }else{
                            ?>
                                <td><img src="./assets/images/send.svg" onclick='notReceiver()' class="req-icon" alt=""></td>
                            <?php
                           }
                        }
                        else{
                            ?>
                                <td><img src="./assets/images/send.svg" onclick='notLoggedin()' class="req-icon" alt=""></td>
                            <?php
                        }
                    
                    ?>
                </tr>
                <?php
            }
        ?>
    </table>
</div>