<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
     <?php
    // load up your config file
    require_once("config.php");     
    require_once(TEMPLATES_PATH . "/header.php");
    
if (session_status() == PHP_SESSION_NONE) 
    session_start(); 

?>
     Welcome to Tennis Club.
     
 </body>
</html>