<script src="/Tennis/scripts/bootstrap.js"></script>
<link rel='stylesheet' type='text/css' href='/Tennis/css/bootstrap.css'>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Tennis Club</title>
</head>
 
<body>
<div class='well' id="header">
    <table>
        <tr>
            <td><h1>TENNIS CLUB</h1></td><td><a href="/Tennis/member">
            <?php        
                require_once 'permissions.php';
                
                if (session_status() == PHP_SESSION_NONE)     
                    session_start();
                
                if (!Logged_In())
                    echo "Login</a>";
                else
                    echo 'Home</a>| <a href="/Tennis/logout.php">Log out</a></td>';
            ?>
        </tr>
    </table>
</div>