<?php

    if (session_status() == PHP_SESSION_NONE) 
        session_start(); 

    require_once("../config.php");     
    require_once(ROOT_PATH . "/opendb.php");   
    require_once(ROOT_PATH . TEMPLATES_PATH . "/header.php");
    require_once("crud.php");
    require_once("../permissions.php");

    if (Can_Do_Inventory() && isset($_POST['update_btn']))
    {
        if (isset($_POST['old_inventorynum']) && $_POST['old_inventorynum'] != "")
        {
            $key_array = array('inventorynum' => $_POST['old_inventorynum']);            
        }
        else
            $key_array = array('inventorynum' => $_POST['inventorynum']);            
        $update_array = $_POST;
        unset($update_array['update_btn']);
        unset($update_array['old_inventorynum']);

        RowUpdate($database, 'inventory_items', $key_array, $update_array);  
        header("Location: inventory.php");
    }
        
    if (isset($_POST['list_update_btn']))
    {
        $memberid = $_POST['list_update_btn'];
    }
    
    if (Can_Do_Inventory())   
    {
        ?>
        <form method="post" action="<?php $_PHP_SELF ?>" >
         <table border='0' >
             <tr>
                 <td>
                     <b>Inventory Number:</b>
                 </td>
                 <td>
                     <input type='text' name='inventorynum' value="<?php echo isset($_POST['inventorynum']) ? $_POST['inventorynum'] : '' ?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Name:</b>
                 </td>
                 <td>
                     <input type='text' name='name' value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Price:</b>
                 </td>
                 <td>
                     <input type='text' name='price' value="<?php echo isset($_POST['price']) ? $_POST['price'] : '' ?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Quantity:</b>
                 </td>
                 <td>
                     <input type='text' name='quantity' value="<?php echo isset($_POST['quantity']) ? $_POST['quantity'] : '' ?>">
                 </td>
             </tr>

             <tr>
                <td>
                    <input type="hidden" name="old_inventorynum" value="<?php echo isset($_POST['inventorynum']) ? $_POST['inventorynum'] : ''; ?>">
                    <input type='submit' value='Update Inventory' name="update_btn"/>
                </td>
             </tr>
         </table>
         </form>
        <?php
    }
    else
    {
        echo "Please login.";
    }