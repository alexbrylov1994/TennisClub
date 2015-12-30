<?php
    function TableShow($result)     // mysqli_num_rows
    {   
        
        echo "<table>";
        echo "<tr>";
        
        // print headers
        for($i = 0; $i < mysqli_num_fields($result); $i++) 
        {
            $field_info = mysqli_fetch_field_direct($result, $i);
            echo "<th>{$field_info->name}</th>";
        }
        echo "</tr>";
        // print data
        while ($tableRow = mysqli_fetch_assoc($result))
        {          
            echo "<tr>";
            foreach ($tableRow as $key => $value) 
            {                  
                echo "<td>" . $tableRow[$key] . "</td>";
                //echo $key;                
            }
            echo "</tr>";    
        }
        echo "</table>";
    }

    function RowShow($result) //I DON'T F---ING KNOW
    {
        echo "<table><tr>";
        
        //print random stuff
        echo "<th> 'Field Name' </th>";
        echo "<th> 'Value' </th>";
        echo "</tr>";
        
        //Print actual stuff
        while ($tableRow = mysqli_fetch_assoc($result))
        {
            foreach ($tableRow as $key => $value)
            {
                echo "<tr>";
                echo "<td>" . $key . "</td>";
                echo "<td>" . $tableRow[$key] . "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    }