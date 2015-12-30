<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    session_start();
    require_once '../opendb.php';
    require_once '../config.php';
    require_once '../header.php';
    
    if (Logged_In())
    {
        if (isset($_POST['list_participate_btn']))
        {
            $memberid   = $_SESSION["memberid"];
            $eid        = $_POST["eventid"];
            $ename      = $_POST["eventname"];
            $edate      = $_POST["eventdate"];

            $query = "SELECT * FROM participates_in WHERE memberid='$memberid' and eventid='$eid'";
            $result = mysqli_query($database,$query) or die(mysqli_error($database));
            $count = mysqli_num_rows($result);
            if ($count == 1)
            {
                echo ("You are already registered for '$ename' on '$edate'.<br>");
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
                $query = "INSERT INTO `mydb`.`participates_in` (`memberid`, `eventid`) VALUES ('$memberid', '$eid')";

                $result = mysqli_query($database,$query) or die(mysqli_error($database));

                echo "You have successfully registered for '$ename' on '$edate'.<br>";
            }
            else
            {
                echo 'Found  more than one event?';
            }
            include 'event_schedule.php';
            return;
        }
        if (isset($_POST['list_unparticipate_btn']))
        {
            $memberid   = $_SESSION["memberid"];
            $eid        = $_POST["eventid"];
            $ename      = $_POST["eventname"];
            $edate      = $_POST["eventdate"];

            $query = "DELETE FROM participates_in WHERE memberid='$memberid' and eventid='$eid'";
            $result = mysqli_query($database,$query) or die(mysqli_error($database));
            include 'event_schedule.php';
            return;
        }
    }
?>