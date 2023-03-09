<?php 
include ('../functions/db.php');
include ('../functions/functions.php');
session_start();
echo $_SESSION['email'];

$user = get_user();
$user_id = $user['id_korisnika'];

$pon = $_POST['select0'];
$uto = $_POST['select1'];
$sre = $_POST['select2'];
$cet = $_POST['select3'];
$pet = $_POST['select4'];

$sql = "UPDATE jelovnik SET
iduci_pon= '$pon',
iduci_uto= '$uto',
iduci_sre= '$sre',
iduci_cet= '$cet',
iduci_pet= '$pet'
WHERE id_korisnika = '$user_id'
";
confirm(query($sql));
$html = "<p style='font-size: 30px;'>Uspesno ste izmenili obrok. <br> <a id='nazad-jelovnik' href='jelovnik.php'>Vrati se na jelovnik.</a></p>";
set_message($html);

?>
