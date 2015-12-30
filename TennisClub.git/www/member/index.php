<html>
 <head>
  <title>Tennis Club</title>
 </head>
 <body>
     <?php
    // load up your config file
    require_once("../config.php");     
    require_once(ROOT_PATH . TEMPLATES_PATH . "/header.php");
    require_once(ROOT_PATH . "/permissions.php");
    
if (session_status() == PHP_SESSION_NONE) 
    session_start(); 

if (Logged_In())
{   
    echo "Welcome, " . $_SESSION['firstname'] . "!<br><br>";
    
    if (Can_Do_Events())
        echo '<a href="event_schedule.php">View Event Scedule</a><br>';

    if (Can_Create_Transaction())
        echo '<a href="../transactionTest.php">Create Transaction</a><br>';

    if (Can_List_Members())
        echo '<a href="../itemTest.php">List Members</a><br>';

    if (Can_Create_Members())
        echo '<a href="create_member.php">Create Members</a><br>';

    if (Can_Update_Members())
        echo '<a href="update_member.php">Update Member</a><br>';

    if (Can_Delete_Members())
        echo '<a href="delete_member.php">Delete Member</a><br>';
    
    if (Can_Update_Members())
        echo '<a href="inventory.php">Inventory List</a><br>';
    
    if (Can_Create_Members())
        echo '<a href="addinventory.php">Add Inventory</a><br>';

    if (Can_Create_Members())
        echo '<a href="updateinventory.php">Update Inventory</a><br>';
    
    if(Can_Create_Transaction()){    
        echo'<a href="../transactionList.php">Transaction List</a><br>';
    }
}
else
{
    include 'login.php';
}

?>
     
 </body>
</html>