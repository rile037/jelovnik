<?php
include('../functions/db.php');
$sql = "SELECT * FROM obrok";
$result = query($sql);

$niz = array();
while ($row = $result -> fetch_assoc())
    array_push($niz, $row['obrok']);
    foreach($niz as $value){
        echo "$value,";
    }
?>