<!DOCTYPE html>
<?php 
    require_once 'header.php';
?>

<body>
    <div class="container">
            <div class="row">
                <h3>Test Member Bootstrap Grid</h3>
                
            </div>
            <div class="row">
                <table id ='memberTable' class="table table-striped table-bordered">
                   <thead>
                    <tr>
                        <th>Member id</th>	
                        <th>Rating</th>
                        <th>Phone#</th>
                        <th>First Name</th>
                        <th>Mid Name</th>		
                        <th>Last Name</th>
                        <th>Renewal</th>
                        <th>Street</th>
                        <th>Street #</th>
                        <th>Joined</th>
                        <th>Postal</th>
                        <th>City</th>
                        <th>Active</th> 
                        <th>Action</th>
                    </tr>
                  </thead>
                <tbody>                   
                
               <?php
   
                function MemberTableShow($result)     // mysqli_num_rows
                {                
                  require_once 'opendb.php';
                  require_once 'member/crud.php';
                  //$rows = TableRetrieve($database, "member");  
                  //$rows = $result;
                   foreach ($result as $row => $value) 
                   {      
                       echo"<tr>";
                      $count = 0;
                        $val_array = array();
                       foreach($value as $key => $col)
                       {    if($key!="password")   
                            {
                                echo "<td>" . $value[$key]."</td>";               
                            }
                            
                            $val_array[$count] = $value[$key];
                            $count++;
                       } 
                        if (Can_Update_Members())
                {
                ?> 
                    <td> 
               
                     
                       <form method="post" action="member/update_member.php">    
                        <input type="hidden" name="memberid" value="<?php echo $val_array[0]; ?>">
                        <input type="hidden" name="rating" value="<?php echo $val_array[1]; ?>">
                        <input type="hidden" name="phonenumber" value="<?php echo $val_array[2]; ?>">
                        <input type="hidden" name="firstname" value="<?php echo $val_array[3]; ?>">
                        <input type="hidden" name="middlename" value="<?php echo $val_array[4]; ?>">
                        <input type="hidden" name="lastname" value="<?php echo $val_array[5]; ?>">
                        <input type="hidden" name="renewaldate" value="<?php echo $val_array[6]; ?>">
                        <input type="hidden" name="streetname" value="<?php echo $val_array[7]; ?>">
                        <input type="hidden" name="streetnum" value="<?php echo $val_array[8]; ?>"> 
                        <input type="hidden" name="datejoined" value="<?php echo $val_array[9]; ?>"> 
                        <input type="hidden" name="postalCode" value="<?php echo $val_array[10]; ?>"> 
                        <input type="hidden" name="city" value="<?php echo $val_array[11]; ?>"> 
                        <input type="hidden" name="password" value="<?php echo $val_array[12]; ?>">
                        <input type="hidden" name="active" value="<?php echo $val_array[13]; ?>">
                        <div class="container">
                         <input type="submit" class="btn btn- btn-sm" name="list_update_button" value="Update">
                        </div>
                       </form>
                    </td>
                    
                    
                    
                <?php                   
                    echo"</tr>";               
                   } 
                }
                 ?>    
                    
                </tbody>                     
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>

<?php 

}
    if (session_status() == PHP_SESSION_NONE) 
        session_start();  
    
    require_once("/config.php");     
    require_once("/opendb.php");  

    require_once("member/crud.php");
    require_once("member/show.php");
    require_once("/permissions.php");

    if (Can_List_Members())   
    {
        $result = TableRetrieve($database, "member");
        MemberTableShow($result);
    }
    else
    {
        echo "Insufficient permissions.";
    }
    
?> 
