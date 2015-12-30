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
                    <form method="post" action="updateinventory.php">    
                        <input type="hidden" name="inventorynum" value="<?php echo $val_array[0]; ?>">
                        <input type="hidden" name="name" value="<?php echo $val_array[1]; ?>">
                        <input type="hidden" name="price" value="<?php echo $val_array[2]; ?>">
                        <input type="hidden" name="quantity" value="<?php echo $val_array[3]; ?>">

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
                        <input type="hidden" name="inventorynum" value="<?php echo $val_array[0]; ?>">
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
    
    if (Can_Do_Inventory() && isset($_POST['list_delete_btn']))
    {
        $key = $_POST['inventorynum'];
        $key_array = array('inventorynum' => $_POST['inventorynum']);
        RowDelete($database, 'inventory_items', $key_array);
    }
    
    
    if (isset($_POST['create_btn']))
    {
        unset($_POST['create_btn']);
        RowCreate($database, 'inventory_items', $_POST);
    }
    
    if (Can_Do_Inventory())   
    {
        $result = TableRetrieve($database, "inventory_items");
        MemberTableShow($result);
    }
    else
    {
        echo "Insufficient permissions.";
    }
    