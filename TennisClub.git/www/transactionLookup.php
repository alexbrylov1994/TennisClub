<!DOCTYPE html>
<?php 
    require_once 'header.php';
?>

<body>
    <div class="container">
            <div class="row">
                <h3>Test Transaction List Grid</h3>
                
            </div>
            <div class="row">
                <table id ='transcationTable' class="table table-striped table-bordered">
                   <thead>
                    <tr>
                        <th>Name</th>	
                        <th>Item Name</th>
                        <th>ID</th>
                        <th>Cashier Fname</th>
                        <th>Cashier Lname</th>
                        <th>Trans #</th>
                    </tr>
                  </thead>
                <tbody>                   
                
               <?php
   
                function TransactionTableShow($result)     // mysqli_num_rows
                {                
                  require_once 'opendb.php';
                  require_once 'member/crud.php';
                  //$rows = TableRetrieve($database, "member");  
                  //$rows = $result;
                  //result2 = gettable;
                  //variable = result2 as $key => $value1;
                   foreach ($result as $row => $value) 
                   {      
                       echo"<tr>";
                     
                        $val_array = array();
                       foreach($value as $key => $col)
                       {    
                                echo "<td>" . $value[$key]."</td>";               
                          
                       } 
        
                       echo"</tr>";               
                   }                
                ?>    
                    
                    
                    
                
                    
                </tbody>                     
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>

   
<?php 
}
 if (session_status() == PHP_SESSION_NONE) 
        session_start();  
    
    require_once("/config.php");     
    require_once("/opendb.php");  

    require_once("member/crud.php");
    require_once("member/show.php");
    require_once("/permissions.php");

    if (Can_List_Members())   
    {
       $query = "SELECT m.firstname AS 'testName', i.name, t.memberid,\n"
    . " a.firstname, a.lastname, t.transactionid FROM member AS m, inventory_items AS i,\n"
    . " transaction AS t, member AS a WHERE m.memberid = t.memberid \n"
    . " AND i.inventorynum = t.inventorynum AND a.memberid = t.cashierid ORDER BY t.transactionid\n"
    . " ";
        $result = mysqli_query($database,$query);
       // $result = TableRetrieve($database, "transaction");
        TransactionTableShow($result);
    }
    else
    {
        echo "Insufficient permissions.";
        header("Location: transactionList.php"); 
    }
    
?> 
