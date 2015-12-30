<!DOCTYPE html>
<?php 
    require_once 'header.php';
?>

<body>
    <div class="container">
            <div class="row">
                <h3>Transaction List Grid</h3>
                
            </div>
            <div class="row">
                <table id ='transcationTable' class="table table-striped table-bordered">
                   <thead>
                    <tr>
                        <th>Transaction id</th>	
                        <th>Date</th>
                        <th>Member</th>
                        <th>Inventory</th>
                        <th>Quantity</th>		
                        <th>Total</th>
                        <th>Cashier</th>
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
           <a href="transactionLookup.php">View Transactions</a><br>
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
        $result = TableRetrieve($database, "transaction");
        TransactionTableShow($result);
    }
    else
    {
        echo "Insufficient permissions.";
    }
    
?> 