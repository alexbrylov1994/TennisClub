<?php 

    require_once("config.php");
    require_once("header.php");
    require_once("permissions.php");
    
?>


    <form class="form-horizontal" role="form" method="post" action="transactionTest.php">
                
        <div class="row">
            
            <div class="col-md-3"> 
                <label for="_member">Members: </label> 
                <select class="form-control" name="membersDrop" id="_member">                     
                    <?php         
                      include "member/crud.php";
                      include "opendb.php";
                      
                      $resultMember = TableRetrieve($database, "member");
                      $resultItem = TableRetrieve($database, "inventory_items");
                        foreach ($resultMember as $row => $value) 
                        {      
                            echo "<option>".$value["firstname"]." ".$value["lastname"]."</option>";
                        }                 
                      ?>
             </select>
            </div>

            
           
            <div class="col-md-3">  
                <label for="_item">Items: </label>
                    <select class="form-control" name="itemsDrop" id="_item"> 
                        <?php         
                         foreach ($resultItem as $row => $value) 
                            {      
                                echo "<option>".$value["name"]."</option>";
                            }  
                          ?>
                    </select>
            </div> 
            
            <div class="col-md-1"> 
                <label for="_quatity">Quantity: </label>
              <select class="form-control" name="quantityDrop" id="_quantity">    
                  <?php    
                  $memberValue = $_POST['membersDrop'];
                  $itemValue = $_POST['itemsDrop'];
                   for ($int = 0; $int <=20; $int++) 
                      {      
                          echo "<option>".$int."</option>";
                      }  
                    ?>
              </select>
          </div> 
            
            <div class="col-md-2"> 
                 <label for="_item">Price: </label>
                <select class="form-control" name="price" id="_price" disabled="true">    
                  <?php         
                     foreach ($resultItem as $row => $value) 
                        {   
                         if($value["name"]==$itemValue)
                         {
                             $price = $value["price"].".00";
                             echo "<option>".$price."</option>";                            
                         }                            
                        }  
                      ?>
                </select>
          </div> 
     </div>
        <div class ="row"> 
            <div class ="spacer"></div>
                <div class ="col-sm-1"> 
                     <input  type="submit" id="_submit"  class="btn btn-primary btn-sm" name="submit" value="Update">
                </div>     
           
        </div>
    </form>
</html>

<?php

    if(isset($_POST['submit']))
    {
        $tid = getNextID($database, 'transaction', 'transactionid') + 2;
        $quantity = $_POST['quantityDrop'];
        $transDate = date("20y-m-d");
        $inventoryNum = 0;
        // get inventory num from $resultItem
        
        foreach ($resultItem as $row => $value) 
        {      
            if ($itemValue == $value["name"])
            {
                $inventoryNum = $value["inventorynum"];
            }
        }          
        
        $membId = 0;
        $total = $price * $quantity;
        //echo $memberValue." itemNum=" . $inventoryNum . " itemvalue = ".$itemValue." tid = ".$tid." total = ".$total;
        
         $namesArr = preg_split("/[\s,]+/", $memberValue); 
         $firstName = $namesArr[0];
         $lastName = $namesArr[1];
         $query = "SELECT memberid FROM member WHERE firstname = '".$firstName. "' AND lastname = '".$lastName."'";
         $membId = mysqli_query($database,$query) or die(mysqli_error($database));
         $rez = mysqli_fetch_assoc($membId); 
         
         $membId = $rez['memberid'];
         //echo "    memberid = " . $membId;
         $value_array = array(
                'transactionid' => $tid,
                'date' => $transDate,
                'memberid' => $membId,
                'inventorynum' => $inventoryNum,
                'amount' => $quantity,
                'totals' => $total,
                'cashierid' => $_SESSION['memberid']
             );
        RowCreate($database, "transaction", $value_array);
        header("Location: transactionList.php");         
     }

//}  
?>

