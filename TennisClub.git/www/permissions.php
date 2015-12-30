<?php

function Can_Create_Transaction()
{
    return ($_SESSION['can_create_transaction']);
}

function Can_List_Members()
{
    return ($_SESSION['can_list_members']);
}

function Can_Do_Inventory()
{
    return ($_SESSION['can_do_inventory']);
}

function Can_Update_Members()
{
    return ($_SESSION['can_update_members']);
}

function Can_Delete_Members()
{
    return ($_SESSION['can_delete_members']);
}

function Can_Create_Members()
{
    return ($_SESSION['can_create_members']);
}

function Can_Do_Events()
{
    return ($_SESSION['can_do_events']);
}


function Get_Permissions($database, $memberid, $password)
{
    //3.1.2 Checking the values are existing in the database or not
    $query = "SELECT * FROM administrator e, member m WHERE e.memberid='$memberid' and m.memberid=e.memberid and m.`password`='$password'";
    $result = mysqli_query($database,$query) or die(mysqli_error($database));
    $count = mysqli_num_rows($result);        
    if ($count == 1)
    {
        $_SESSION['can_create_transaction'] = 1;
        $_SESSION['can_do_events'] = 1;
        $_SESSION['can_list_members'] = 1;
        $_SESSION['can_create_members'] = 1;
        $_SESSION['can_update_members'] = 1;
        $_SESSION['can_delete_members'] = 1;
        $_SESSION['memberid'] = $memberid;
        $_SESSION['can_do_inventory'] = 1;
        return $result;
    }

    $query = "SELECT * FROM boardmember e, member m WHERE e.memberid='$memberid' and m.memberid=e.memberid and m.`password`='$password'";
    $result = mysqli_query($database,$query) or die(mysqli_error($database));
    $count = mysqli_num_rows($result);        
    if ($count == 1)
    {
        $_SESSION['can_create_transaction'] = 1;
        $_SESSION['can_do_events'] = 1;
        $_SESSION['can_list_members'] = 1;
        $_SESSION['can_create_members'] = 1;
        $_SESSION['can_update_members'] = 1;
        $_SESSION['can_delete_members'] = 0;
        $_SESSION['memberid'] = $memberid;
        $_SESSION['can_do_inventory'] = 0;
        return $result;
    }

    $query = "SELECT * FROM employee e, member m WHERE e.memberid='$memberid' and m.memberid=e.memberid and m.`password`='$password'";
    $result = mysqli_query($database,$query) or die(mysqli_error($database));
    $count = mysqli_num_rows($result);        
    if ($count == 1)
    {
        $_SESSION['can_create_transaction'] = 1;
        $_SESSION['can_do_events'] = 1;
        $_SESSION['can_list_members'] = 0;
        $_SESSION['can_create_members'] = 0;
        $_SESSION['can_update_members'] = 0;
        $_SESSION['can_delete_members'] = 0;
        $_SESSION['memberid'] = $memberid;
        $_SESSION['can_do_inventory'] = 0;
        return $result;
    }

    $query = "SELECT * FROM member WHERE memberid='$memberid' and `password`='$password'";
    $result = mysqli_query($database,$query) or die(mysqli_error($database));
    $count = mysqli_num_rows($result);        
    if ($count == 1)
    {
        $_SESSION['can_create_transaction'] = 0;
        $_SESSION['can_do_events'] = 1;
        $_SESSION['can_list_members'] = 0;
        $_SESSION['can_create_members'] = 0;
        $_SESSION['can_update_members'] = 0;
        $_SESSION['can_delete_members'] = 0;
        $_SESSION['memberid'] = $memberid;
        $_SESSION['can_do_inventory'] = 0;
        return $result;
    }
}

function Logged_In()
{
    if (isset($_SESSION['memberid']))
        return true;
    
    return false;
}
