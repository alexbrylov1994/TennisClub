<?php

include '../opendb.php';
include 'crud.php';
include 'show.php';
//$result=TableRetrieve($database, 'event');
$fields = array("name", "date", "minlimit", "maxlimit", "budget", "fee", "dept");
$pkey = array("name" => "Tennis2000", "date" => "1999-12-31");
$result = RowRetrieve($database, 'event', $fields, $pkey);
RowShow($result);