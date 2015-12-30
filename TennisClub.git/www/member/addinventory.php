<?php

    if (session_status() == PHP_SESSION_NONE) 
        session_start(); 

    require_once("../config.php");     
    require_once(ROOT_PATH . "/opendb.php");   
    require_once(ROOT_PATH . TEMPLATES_PATH . "/header.php");
    require_once("crud.php");
    require_once("../permissions.php");
    
    if (Can_Do_Inventory())   
    {
        $currDate = date("20y-m-d");
        ?>
        <form method="post" action = "inventory.php" >
         <table border='0' >
             <tr>
                 <td>
                     <b>Inventory ID:</b>
                 </td>
                 <td>
                     <input type='text' name='inventorynum' value="<?php echo isset($_POST['memberid']) ? $_POST['inventorynum'] : '' ?>">
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
                 <td><input type='submit' value='Create Inventory' name="create_btn"/>
             </tr>
         </table>
         </form>
        <?php
    }
    else
    {
        echo "Please login.";
    }