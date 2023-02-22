<?php 
include ('..functions/db.php');
include ('f../unctions/functions.php');
session_start();
echo $_SESSION['email'];

$user = get_user();
$user_id = $user['id_korisnika'];

$pon = $_POST['select0'];
$uto = $_POST['select1'];
$sre = $_POST['select2'];
$cet = $_POST['select3'];
$pet = $_POST['select4'];

$sql = "UPDATE korisnik SET
ponedeljak= '$pon',
utorak= '$uto',
sreda= '$sre',
cetvrtak= '$cet',
petak= '$pet'
WHERE id_korisnika = '$user_id'
";
confirm(query($sql));
?>
