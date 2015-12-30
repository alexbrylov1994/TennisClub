<html>
    <head>
        <title>Event Schedule</title>		
    </head>
	<body bgcolor="#FFFFCC">
<?php

    function ParticipateRow($eid, $ename, $edate)
    {
        ?>
        <tr>
            <td align="center">             
                <?php echo $ename;?>
            </td>
            <td align ="center"colspan="1" rowspan="1">         
                <?php echo $edate;?>
            </td>
            <td>
                <form method="post" action="participate.php">    
                    <input type="hidden" name="eventname" value="<?php echo $ename; ?>">
                    <input type="hidden" name="eventdate" value="<?php echo $edate; ?>">
                    <input type="hidden" name="eventid" value="<?php echo $eid; ?>">
                    <input type='submit' value='Un-Participate' name="list_unparticipate_btn"/>
                </form>
            </td>
        </tr>
        <?php
    }
    
    function VolunteerRow($eid, $ename, $edate)
    {
        ?>
        <tr>
            <td align="center">             
                <?php echo $ename;?>
            </td>
            <td align ="center"colspan="1" rowspan="1">         
                <?php echo $edate;?>
            </td>
            <td>
                <form method="post" action="volunteer.php">    
                    <input type="hidden" name="eventname" value="<?php echo $ename; ?>">
                    <input type="hidden" name="eventdate" value="<?php echo $edate; ?>">
                    <input type="hidden" name="eventid" value="<?php echo $eid; ?>">
                    <input type='submit' value='Un-Volunteer' name="list_unvolunteer_btn"/>
                </form>
            </td>
        </tr>
        <?php
    }
    
    function UnregisteredRow($eid, $ename, $edate)
    {
        ?>
        <tr>
            <td align="center">             
                <?php echo $ename;?>
            </td>
            <td width="200" align ="center"colspan="1" rowspan="1">         
                <?php echo $edate;?>
            </td>
            <td width="80">
                <form method="post" action="volunteer.php">    
                    <input type="hidden" name="eventname" value="<?php echo $ename; ?>">
                    <input type="hidden" name="eventdate" value="<?php echo $edate; ?>">
                    <input type="hidden" name="eventid" value="<?php echo $eid; ?>">
                    <input type='submit' value='Volunteer' name="list_volunteer_btn"/>
                </form>
            </td>
            <td>
                <form method="post" action="participate.php">    
                    <input type="hidden" name="eventname" value="<?php echo $ename; ?>">
                    <input type="hidden" name="eventdate" value="<?php echo $edate; ?>">
                    <input type="hidden" name="eventid" value="<?php echo $eid; ?>">
                    <input type='submit' value='Participate' name="list_participate_btn"/>
                </form>
            </td>
        </tr>
        <?php
    }
    
    if (session_status() == PHP_SESSION_NONE) 
        session_start(); 

    require_once '../opendb.php';
    require_once("../config.php");     
    require_once("../header.php");
    require_once '../permissions.php';
    
    if (Can_Do_Events())
    {
        $memberid = $_SESSION['memberid'];
        $query = "SELECT e.id, e.name, e.date FROM event e WHERE EXISTS (SELECT * FROM event, volunteers_for WHERE memberid = '$memberid' and e.id = eventid)";        
        $result = mysqli_query($database,$query) or die(mysqli_error($database));
 ?>
        <table width ='100%'>
            <tr><td>Currently Volunteering:</td></tr>
            <tr>
                <td align='center'>
                    <b>Name</b>
                </td>
                <td align='center'>
                    <b>Date</b>
                </td>
            </tr>
        <?php
            while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
            {
               $eid   = $row["id"];
               $edate = $row["date"];
               $ename = $row["name"];
               VolunteerRow($eid, $ename, $edate);
            }
                    
        $query = "SELECT e.id, e.name, e.date FROM event e WHERE EXISTS (SELECT * FROM event, participates_in WHERE memberid = '$memberid' and e.id = eventid)";        
        $result = mysqli_query($database,$query) or die(mysqli_error($database));
        ?>
            <tr><td>Currently Participating:</td></tr>
            <tr>
                <td align='center'>
                    <b>Name</b>
                </td>
                <td align='center'>
                    <b>Date</b>
                </td>
            </tr>
        <?php
            while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
            {
               $eid   = $row["id"];
               $edate = $row["date"];
               $ename = $row["name"];
               ParticipateRow($eid, $ename, $edate);
            }
            
        //$query = "SELECT eventname, eventdate FROM participates_in WHERE memberid='$memberid'";
        $query = "SELECT e.id, e.name, e.date FROM event e WHERE NOT EXISTS (SELECT * FROM event, volunteers_for v, participates_in p WHERE "
                . "(p.memberid = '$memberid' and e.id = p.eventid) or "
                . "(v.memberid = '$memberid' and e.id = v.eventid))";
        $result = mysqli_query($database,$query) or die(mysqli_error($database));        
        ?>
            <tr><td>Not Registered:</td></tr>
            <tr>
                <td align='center'>
                    <b>Name</b>
                </td>
                <td align='center'>
                    <b>Date</b>
                </td>
            </tr>
        <?php
            while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
            {
               $eid   = $row["id"];
               $edate = $row["date"];
               $ename = $row["name"];
               UnregisteredRow($eid, $ename, $edate);
            }
        echo "</table>";        
    }
    else
    {
        echo 'Insufficient permissions.';        
    }
?>
</body>
</html>