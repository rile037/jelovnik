<?php 

include('../functions/db.php');
include('../functions/functions.php');
session_start();
$izabrana_jela = [];

$user = get_user();
$user_id = $user['id_korisnika'];

$sql = "SELECT * from korisnik WHERE id_korisnika = '$user_id'";
$result = query($sql);

$row = $result -> fetch_assoc();

array_push($izabrana_jela, $row['ponedeljak'], $row['utorak'], $row['sreda'], $row['cetvrtak'], $row['petak']);

foreach($izabrana_jela as $value){
  echo "$value,";
}

?>