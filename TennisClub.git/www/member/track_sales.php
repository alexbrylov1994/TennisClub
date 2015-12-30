<?php
    if (session_status() == PHP_SESSION_NONE) 
        session_start(); 

        require_once("../config.php");     
        require_once(ROOT_PATH . "/opendb.php");   
        require_once(ROOT_PATH . TEMPLATES_PATH . "/header.php");
        
        
        if (isset($_SESSION['employeeid']))
        {
            ?>
            <form method="post" action=".php">    
                <table border="0" >
                    <tr>
                        <td>
                            <b>Start Date</b>
                        </td>
                        <td><input type="date" name="start">
                    </tr>
                    <tr>
                        <td><b>End Date</b></td>
                        <td><input type="date" name="end"/></td>
                    </tr> <br/>
                    <tr>
                        <td><input type="submit" value="Find"/>        
                    </tr>
                </table>
            </form>
            <?php
        }