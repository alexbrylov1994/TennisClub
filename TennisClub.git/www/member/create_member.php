<?php

    if (session_status() == PHP_SESSION_NONE) 
        session_start(); 

    require_once("../config.php");     
    require_once(ROOT_PATH . "/opendb.php");   
    require_once(ROOT_PATH . TEMPLATES_PATH . "/header.php");
    require_once("crud.php");
    require_once("../permissions.php");

    if (isset($_POST['create_btn']))
    {
        unset($_POST['create_btn']);
        RowCreate($database, 'member', $_POST);
    }
    
    if (Can_Create_Members())   
    {
        $currDate = date("20y-m-d");
        ?>
        <form method="post" action="<?php $_PHP_SELF ?>" >
         <table border='0' >
             <tr>
                 <td>
                     <b>Member ID:</b>
                 </td>
                 <td>
                     <input type='text' name='memberid' value="<?php echo isset($_POST['memberid']) ? $_POST['memberid'] : '' ?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>First Name:</b>
                 </td>
                 <td>
                     <input type='text' name='firstname' value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Middle Name:</b>
                 </td>
                 <td>
                     <input type='text' name='middlename' value="<?php echo isset($_POST['middlename']) ? $_POST['middlename'] : '' ?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Last Name:</b>
                 </td>
                 <td>
                     <input type='text' name='lastname' value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Phone#:</b>
                 </td>
                 <td>
                     <input type='text' name='phonenumber' value="<?php echo isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '' ?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Street#:</b>
                 </td>
                 <td>
                     <input type='text' name='streetnum' value="<?php echo isset($_POST['streetnum']) ? $_POST['streetnum'] : '' ?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Street Name:</b>
                 </td>
                 <td>
                     <input type='text' name='streetname' value="<?php echo isset($_POST['streetname']) ? $_POST['streetname'] : '' ?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>City:</b>
                 </td>
                 <td>
                     <input type='text' name='city' value="<?php echo isset($_POST['city']) ? $_POST['city'] : '' ?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Postal Code:</b>
                 </td>
                 <td>
                     <input type='text' name='postalcode' value="<?php echo isset($_POST['postalcode']) ? $_POST['postalcode'] : '' ?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Rating:</b>
                 </td>
                 <td>
                     <input type='text' name='rating' value="<?php echo isset($_POST['rating']) ? $_POST['rating'] : '' ?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Renewal Date:</b>
                 </td>
                 <td>
                     <input type='date' name='renewaldate' value="<?php echo isset($_POST['renewaldate']) ? $_POST['renewaldate'] : $currDate ?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Date Joined:</b>
                 </td>
                 <td>
                     <input type='date' name='datejoined' value="<?php echo isset($_POST['datejoined']) ? $_POST['datejoined'] : $currDate ?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Password:</b>
                 </td>
                 <td>
                     <input type='password' name='password' value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Active:</b>
                 </td>
                 <td>
                     <input type='active' name='active' value="<?php echo isset($_POST['active']) ? $_POST['active'] : '1' ?>">
                 </td>
             </tr>
             <tr>
                 <td><input type='submit' value='Create Member' name="create_btn"/>
             </tr>
         </table>
         </form>
        <?php
    }
    else
    {
        echo "Please login.";
    }