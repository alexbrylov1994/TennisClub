<?php
    $object = new User;
    print_r($object); 
    echo "<br>";
    $object->name = "Joe";
    $object->password = "mypass";
    print_r($object); 
    echo "<br>";
    $object->save_user();

    class User
    {
        public $name, $password;

        function save_user()
        {
            echo "Save User code goes here";
        }
    }
    
    class Member
    {
        public $name, $password, $id;
    }

    class Employee
    {
        public $name, $password, $id;
    }
    
    class Admin
    {
        public $name, $password, $id;
    }
    
    
$fruit = array('a' => 'apple', 'b' => 'banana', 'c' => 'cranberry');

    reset($fruit);
    while (list($key, $val) = each($fruit)) {
        echo "$key => $val\n";

        $test = "test:";
        $test .= "huh";
        echo $test;
    }

    require_once 'opendb.php';
    require_once 'employee/crud.php';
    require_once 'employee/show.php';
    
    $key_array = array('name' => 'Tennis2000');
    $col = array('name', 'date');
    $result = RowRetrieve($database, "event", $col, $key_array);
    TableShow($result);
/*
    $table = "event";    
    $key_array = array('name' => 'Tennis2001', 'date' => '2000-12-31');
    $update_array = array('fee' => 1000, 'name' => 'Tennis2001');
    $create_array = array(
        'name' => 'Tennis2005', 
        'date' => '2004-12-31', 
        'minlimit' => 6, 
        'maxlimit' => 7, 
        'fee' => 12, 
        'budget' => 200, 
        'dept' => 0);
     
    RowCreate($database, "event", $create_array);
    
    RowDelete($database, $table, $key_array);
    //RowUpdate($database, $table, $key_array, $update_array);
    
    $columns = array('fee', 'date', 'name');
    $key_array = array('name' => 'Tennis2000', 'date' => '1999-12-31');
    RowRetrieve($database, "event", $columns, $key_array);
    TableRetrieve($database, "member");
    */
    
/*
    include "opendb.php";
    
    $query = "SELECT * FROM member";
        $result = mysqli_query($database,$query) or die(mysqli_error($database));
        
        while ($tableRow = mysqli_fetch_assoc($result))
            foreach ($tableRow as $key => $value) { // Loops 4 times because there are 4 columns
                echo $key;
                echo $tableRow[$key]; // Same output as previous line
            }
        
/*
        echo "<table><tr> <th>memberid</th><th>rating</th><th>phonenumber</th><th>firstname</th><th>middlename</th><th>lastname</th><th>renewaldate</th><th>streetname</th><th>streetnum</th><th>datejoined</th><th>postalcode</th><th>city</th><th>password</th></tr>";
        for ($j = 0 ; $j < $rows ; ++$j)
        {
            $row = mysqli_fetch_row($result);
            echo "<tr>";
            for ($k = 0 ; $k < 13 ; ++$k)
            echo "<td>$row[$k]</td>";
            echo "</tr>";
        }
        echo "</table>";*/
        
?>

<input type='url' name='site' list='links'>
<datalist id='links'>
<option label='Google' value='http://google.com'>
<option label='Yahoo!' value='http://yahoo.com'>
<option label='Bing' value='http://bing.com'>
<option label='Ask' value='http://ask.com'>
</datalist>
