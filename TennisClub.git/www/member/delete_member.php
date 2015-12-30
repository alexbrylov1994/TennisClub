<?php

    function GenericForm($field_array, $dest, $button_label, $button_name)
    {
        ?>
        <form method="post" action="<?php echo $dest; ?>">
        <table border='0' >

        <?php   
        list($key, $val) = each($field_array);
        do
        {
            $field_array[$key] = $val[0];      
            $col = $val[0];
            $type = $val[1];
            echo "<tr><td><b>";
            echo $key . ":</b></td><td>";
            echo "<input type='$type' name='$col'>";
            echo "</td></tr>";            
            
            // check next
            unset($key);
            unset($val);
            list($key, $val) = each($field_array);
        } while (isset($key) && isset($val));
                
        echo '<tr><td><input type="submit" name="'.$button_name.'" value="'.$button_label.'"/></tr>';
        echo "</table></form>"; 
    }

    if (session_status() == PHP_SESSION_NONE) 
        session_start(); 

    require_once("../config.php");     
    require_once(ROOT_PATH . "/opendb.php");   
    require_once(ROOT_PATH . TEMPLATES_PATH . "/header.php");
    require_once("crud.php");
    require_once("../permissions.php");

    if (Can_Delete_Members() && isset($_POST['delete_btn']))
    {
        $key = $_POST['memberid'];
        $key_array = array('memberid' => $_POST['memberid']);
        RowDelete($database, 'member', $key_array);
        header("Location: list_members.php");         
    }
    
    if (isset($_POST['list_delete_btn']))
    {
        $memberid = $_POST['list_delete_btn'];
    }
    
    if (Can_Delete_Members())   
    {
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
                 <td><input type='submit' value='Delete Member' name="delete_btn"/>
             </tr>
         </table>
         </form>
        <?php
    }
    else
    {
        echo "Please login.";
    }