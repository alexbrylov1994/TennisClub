<html>
    <head>
        <title>Register for Event</title>		
    </head>
	<body bgcolor="#FFFFCC">
<?php  

session_start();

function RegisterEvent($memberid, $ename, $edate)
{            
    require_once '../opendb.php';   
    require_once("../config.php");     
    require_once('../' . TEMPLATES_PATH . "/header.php");
    
     // first check if already registered
     $query = "SELECT * FROM participates_in WHERE memberid='$memberid' and eventname='$ename' and eventdate='$edate'";
     $result = mysqli_query($database,$query) or die(mysqli_error($database));
     $count = mysqli_num_rows($result);
     if ($count == 1)
     {
         echo ("You are already registered for '$ename' on '$edate'.<br>");
         return;
     }

     //3.1.2 Checking the values are existing in the database or not
     $query = "SELECT * FROM event WHERE name='$ename' and date='$edate'";

     $result = mysqli_query($database,$query) or die(mysqli_error($database));

     $count = mysqli_num_rows($result);
     if ($count == 0)
     {
         echo "Event not found.<br>";
     }
     else        
     if ($count == 1)
     {     
         $query = "INSERT INTO `mydb`.`participates_in` (`memberid`, `eventname`, `eventdate`) VALUES ('$memberid', '$ename', '$edate')";

         $result = mysqli_query($database,$query) or die(mysqli_error($database));

         echo "You have successfully registered for '$ename' on '$edate'.<br>";
     }
     else
     {
         echo 'Found  more than one event?';
     }
 }

function UnregisterEvent($memberid, $ename, $edate)
{            
    require_once '../opendb.php';   
    require_once("../config.php");     
    require_once('../' . TEMPLATES_PATH . "/header.php");
    
     // check if already registered
     $query = "SELECT * FROM participates_in WHERE memberid='$memberid' and eventname='$ename' and eventdate='$edate'";
     $result = mysqli_query($database,$query) or die(mysqli_error($database));
     $count = mysqli_num_rows($result);
     if ($count == 0)
     {
         echo ("You are not registered for '$ename' on '$edate'.<br>");
         return;
     }
     else
     if ($count == 1)
     {
        $query = "DELETE FROM participates_in WHERE memberid='$memberid' and eventname='$ename' and eventdate='$edate'";
        $result = mysqli_query($database,$query) or die(mysqli_error($database));     
        echo "You have successfully unregistered for '$ename' on '$edate'.<br>";
     }
 }
 
if (isset($_SESSION['memberid']) and isset($_POST['name']) and isset($_POST['date']) and isset($_POST['button']))
{    
    //3.1.1 Assigning posted values to variables.
    $ename = $_POST['name'];
    $edate = $_POST['date'];
    $memberid = $_SESSION['memberid'];        
    $button = $_POST['button'];
    
    if ($button == "Register")
        RegisterEvent($memberid, $ename, $edate);
    else
        UnregisterEvent($memberid, $ename, $edate);
    echo "<a href='../member.php'>Members</a>";
}   
else
{
    echo 'Please login.';
}

?>
</body>
</html>