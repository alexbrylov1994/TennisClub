<?php
   
    function MemberTableShow($result)     // mysqli_num_rows
    {   
        $rows = mysqli_num_rows($result);
        
        echo "<table>";
        echo "<table><tr>";
        
        // print headers
        for($i = 0; $i < mysqli_num_fields($result); $i++) 
        {
            $field_info = mysqli_fetch_field_direct($result, $i);
            echo "<th>{$field_info->name}</th>";
        }
        
        // print data
        while ($tableRow = mysqli_fetch_assoc($result))
        {          
            echo "<tr>";         
            $count = 0;
            $val_array = array();
            foreach ($tableRow as $key => $value) 
            {                  
                echo "<td>" . $tableRow[$key] . "</td>";
                $val_array[$count] = $value;
                $count++;
            }
            ?>
            <td>    
                <?php
                if (Can_Update_Members())
                {
                    ?>
                    <form method="post" action="update_member.php">    
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
                        <input type='submit' value='Update' name="list_update_btn"/>
                    </form>
                    <?php
                }
                ?>
            </td>
            <td>
                <?php
                if (Can_Delete_Members())
                {
                    ?>
                    <form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">        
                        <input type="hidden" name="memberid" value="<?php echo $val_array[0]; ?>">
                        <input type='submit' value='Delete' name="list_delete_btn"/>
                    </form>
                    <?php
                }
                ?>
            </td>
            <?php
            echo "</tr>";                
        }
        echo "</table>";
    }
    
    if (session_status() == PHP_SESSION_NONE) 
        session_start(); 

    require_once("../config.php");     
    require_once(ROOT_PATH . "/opendb.php");   
    require_once(ROOT_PATH . TEMPLATES_PATH . "/header.php");
    require_once("crud.php");
    require_once("show.php");
    require_once("../permissions.php");
    
    if (Can_Delete_Members() && isset($_POST['list_delete_btn']))
    {
        $key = $_POST['memberid'];
        $key_array = array('memberid' => $_POST['memberid']);
        RowDelete($database, 'member', $key_array);
    }
    
    if (Can_List_Members())   
    {
        $result = TableRetrieve($database, "member");
        MemberTableShow($result);
    }
    else
    {
        echo "Insufficient permissions.";
    }