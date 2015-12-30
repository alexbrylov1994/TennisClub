<?php

    function RowCreate($database, $table, $value_array)
    {    
        // build query
        $query = "INSERT INTO " . $table . " ";
        $columns = "(";
        $values = "(";
        
        list($key, $val) = each($value_array);
        do
        {
            $columns .= $key;        
            $values .= "'$val'";        
            // check next
            unset($key);
            unset($val);
            list($key, $val) = each($value_array);
            if (isset($key) && isset($val))
            {
                $columns .= ", ";
                $values .= ", ";
            }
        } while (isset($key) && isset($val));

        $columns .= ")";
        $values .= ")";
        $query .= $columns . " VALUES " . $values;
        $result = mysqli_query($database, $query) or die(mysqli_error($database));
        return $result;
        
    }
    
    function RowDelete($database, $table, $key_array)
    {            
          // build query
        $query = "DELETE FROM " . $table . " WHERE ";
        
        // key values
        list($key, $val) = each($key_array);
        do
        {
            $query .= $key . " = '$val'";        
            // check next
            list($key, $val) = each($key_array);
            if ($key && $val)
            {
                $query .= " AND ";
            }
        } while ($key && $val);        
        
        $result = mysqli_query($database, $query) or die(mysqli_error($database));
        return $result;
    }
    
    function RowUpdate($database, $table, $key_array, $update_array)
    {    
        // build query
        $query = "UPDATE " . $table . " SET ";
        
        // update values        
        list($key, $val) = each($update_array);
        do
        {
            $query .= $key . " = '$val'";        
            // check next
            unset($key);
            unset($val);
            list($key, $val) = each($update_array);
            if (isset($key) && isset($val))
            {
                $query .= ", ";
            }
        } while (isset($key) && isset($val));
        
        $query .= " WHERE ";
        
        // key values
        list($key, $val) = each($key_array);
        do
        {
            $query .= $key . " = '$val'";        
            // check next
            list($key, $val) = each($key_array);
            if ($key && $val)
            {
                $query .= " AND ";
            }
        } while ($key && $val);
        //echo $query;
        $result = mysqli_query($database, $query) or die(mysqli_error($database));
        return $result;
    }
    
    function TableRetrieve($database, $table)
    {   
        
        $query = "SELECT * FROM " . $table;
        $result = mysqli_query($database,$query) or die(mysqli_error($database));
        return $result; 
        
    }
    
    function getNextID($database, $table, $column)
    {
        $query = "SELECT max(".$column.") as '$column' FROM " . $table;        
                      
        $result = mysqli_query($database,$query) or die(mysqli_error($database));       
        
        while ($tableRow = mysqli_fetch_assoc($result))
        {
            foreach ($tableRow as $key => $value)
            {
                //echo "MAX: ".$tableRow[$key];
                return $tableRow[$key];
            }
        }
        return -1;
    }
    
    function RowRetrieve($database, $table, $column_array, $key_array)
    {    
        $query = "SELECT ";
        $col_str = "";
        $key_str = "";
        
        $size = count($column_array);
        // column names
        for ($i = 0; $i < $size; $i++) {
            $col_str .= $column_array[$i];

            if ($i < ($size - 1))
                $col_str .= ", ";
        }
        
        $query .= $col_str;
        $query .= " FROM " . $table;
        
        // key values
        list($key, $val) = each($key_array);
        do
        {
            $key_str .= $key . " = '$val'";        
            // check next
            list($key, $val) = each($key_array);
            if ($key && $val)
            {
                $key_str .= " AND ";
            }
        } while ($key && $val);  
                
        $query .= " WHERE " . $key_str;
        $result = mysqli_query($database,$query) or die(mysqli_error($database));
        //$rows = mysqli_num_rows($result);                
        return $result;
    }