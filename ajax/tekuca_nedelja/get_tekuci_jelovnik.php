<?php 

include('../../functions/db.php');
include('../../functions/functions.php');
session_start();
$izabrana_jela = [];

$user = get_user();
$user_id = $user['id_korisnika'];

$sql = "SELECT * from jelovnik WHERE id_korisnika = '$user_id'";
$result = query($sql);

$row = $result -> fetch_assoc();

array_push($izabrana_jela, $row['tekuci_pon'], $row['tekuci_uto'], $row['tekuci_sre'], $row['tekuci_cet'], $row['tekuci_pet']);

foreach($izabrana_jela as $value){
  echo "$value,";
}

?>