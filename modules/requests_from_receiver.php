<?php


    /* 
    
        This module is to show the receiver sent requets to the hospital 
    
    */
    
    $requests = get_receiver_requests($conn); # For getting recivers requests data

    if(count($requests)==0){
        ?>
            <h4 class="text-primary">No Requests Found</h4>
        <?php
    }else{
        ?>
        <div id="table-data-frame">
            <table class="table" id="user-data">
                <tr>
                    <th>Receiver name</th>
                    <th>Age</th>
                    <th>Receivers Blood Group</th>
                    <th>Requested</th>
                    <th>Quantity</th>
                    <th>Message</th>
                    <th>Contact</th>
                    <th>Location</th>
                    <th>Date</th>
                </tr>
        <?php
        foreach($requests as $key=>$value){
            ?>
                <tr>
                    <td><?php echo $value["name"]?></td>
                    <td><?php echo $value["age"]?></td>
                    <td><?php echo $value["receiver_bg"]?></td>
                    <td><?php echo $value["req_bg"]?></td>
                    <td><?php echo $value["qnt"]?></td>
                    <td><?php echo $value["msg"]?></td>
                    <td><?php echo $value["contact"]?></td>
                    <td><?php echo $value["city"].",".$value["state"]."-".$value["zipcode"]?></td>
                    <td><?php echo explode(" ",$value["time"])[0]?></td>                              
                </tr>
                <?php
            }
            ?>
            </table>
        </div>
            <?php
        }
    ?>  