<?php 
include('../../functions/db.php');
include('../../functions/functions.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $jelo = ($_POST['jelo']);

    $sql = "INSERT INTO obrok(obrok)";
    $sql .= "VALUES('$jelo')";
    confirm(query($sql));
    echo "Uspesno ste dodali jelo!";
  }
  ?>