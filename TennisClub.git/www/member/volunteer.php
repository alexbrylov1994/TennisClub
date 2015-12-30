<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    if (session_status() == PHP_SESSION_NONE) 
        session_start(); 
    
    require_once '../opendb.php';
    require_once '../config.php';
    require_once '../header.php';
    require_once '../permissions.php';
    require_once 'crud.php';
    
    if (!Logged_In())
    {
        echo "Please login.";
    }
    else
    {
        if (isset($_POST['list_volunteer_btn']))
        {
            $memberid   = $_SESSION["memberid"];
            $ename      = $_POST["eventname"];
            $edate      = $_POST["eventdate"];
            $eid        = $_POST["eventid"];

            $query = "SELECT * FROM volunteers_for WHERE memberid='$memberid' and eventid='$eid'";
            $result = mysqli_query($database,$query) or die(mysqli_error($database));
            $count = mysqli_num_rows($result);
            if ($count == 1)
            {
                echo ("You are already registered as a volunteer for '$ename' on '$edate'.<br>");
                return;
            }

            //3.1.2 Checking the values are existing in the database or not
            $query = "SELECT * FROM event WHERE id='$eid'";

            $result = mysqli_query($database,$query) or die(mysqli_error($database));

            $count = mysqli_num_rows($result);
            if ($count == 0)
            {
                echo "Event not found.<br>";
            }
            else        
            if ($count == 1)
            {     
                $query = "INSERT INTO `mydb`.`volunteers_for` (`memberid`, `eventid`) VALUES ('$memberid', '$eid')";

                $result = mysqli_query($database,$query) or die(mysqli_error($database));

                echo "You have successfully registered as a volunteer for '$ename' on '$edate'.<br>";
                include 'event_schedule.php';
                return;
            }
        }
        else    // unvolunteering
        {
            $memberid   = $_SESSION["memberid"];
            $eid        = $_POST["eventid"];
            $ename      = $_POST["eventname"];
            $edate      = $_POST["eventdate"];

            $query = "DELETE FROM volunteers_for WHERE memberid='$memberid' and eventid='$eid'";
            $result = mysqli_query($database,$query) or die(mysqli_error($database));            
            include 'event_schedule.php';
            return;
        }
    }
?>