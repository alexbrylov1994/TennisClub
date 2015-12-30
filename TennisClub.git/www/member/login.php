<?php
    if (session_status() == PHP_SESSION_NONE) 
        session_start(); 

    require_once("../config.php");     
    require_once(ROOT_PATH . "/opendb.php");   
    require_once(ROOT_PATH . TEMPLATES_PATH . "/header.php");        
    require_once("../permissions.php");

    if (isset($_POST['login_btn'])) //isset($_POST['adminid']) and isset($_POST['password']))
    {
        $memberid = $_POST['memberid'];
        $password = $_POST['password'];

        $result = Get_Permissions($database, $memberid, $password);

        if (Logged_In())
        {
            $row = mysqli_fetch_array($result, MYSQL_ASSOC);            
            $_SESSION['firstname'] = $row["firstname"];
        }
        else
        {
            echo "Invalid Login Credentials.";
            unset($_SESSION['memberid']);
        }
    }
    //3.1.4 if the user is logged in Greets the user with message
    if (isset($_SESSION["memberid"]))
    {
        header("Location: index.php");
    }
?>
    <html>
    <head>
        <title>Login</title>
    </head>
    <body bgcolor="#FFFFCC">
<center>
<h3>Login</h3>
<hr />
<form method="post" action="<?php $_PHP_SELF ?>" >
<table border="0" >
    <tr>
        <td>
            <b>Member ID</b>
        </td>
        <td><input type="text" name="memberid">
    </tr>
    <tr>
        <td><b>Password</b></td>
        <td><input type="password" name="password"/></td>
    </tr> <br/>
    <tr>
        <td><input type="submit" value="Login" name="login_btn"/>        
    </tr>
</table>
</form>
</center>
    

</body>
</html>
