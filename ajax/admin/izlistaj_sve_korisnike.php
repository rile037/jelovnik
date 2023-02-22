<?php 
include('../../functions/db.php');
if($_SERVER["REQUEST_METHOD"] == "GET"){

$sql = "SELECT * FROM korisnik";
$result = query($sql);
echo "
<div class='center'>
<div id='pretraga'>
<p style='font-size: 25px; padding-bottom: 1px;'>Pretraži korisnika</p>
<form method='GET' id='pretrazi_korisnika'>
  <input type='search' class='input' id='ime' name='ime' placeholder='Ime zaposlenog...'></input>
  <button type='submit' class='btn pretrazi'><i class='fa fa-search' aria-hidden='true'></i></button>
</form></div></div>";

while ($row = $result -> fetch_assoc()){
  echo 
  "
<div class='center'>
  <table class='styled-table'>
  <thead>
    <tr>
      <th>".$row['id_korisnika']." - ".$row['ime_prezime']."</th>
      <th style='text-align: right; padding-right: 20px;'>
      <form id='izmeni_korisnika'>
      <a value='".$row['id_korisnika']."' href='' id='izmeniKorisnika'>Izmeni</a>
      </form></th>
    </tr>
  </thead>
  <tbody>
  <tr>
  <td><b>Ponedeljak</b></td>
  <td><b>".$row['ponedeljak']."</b></td>
  </tr>
  <tr>
  <td><b>Utorak</b></td>
  <td><b>".$row['utorak']."</b></td>
  </tr>
  <tr>
  <td><b>Sreda</b></td>
  <td><b>".$row['sreda']."</b></td>
  </tr>
  <tr>
  <td><b>Cetvrtak</b></td>
  <td><b>".$row['cetvrtak']."</b></td>
  </tr>
  <tr>
  <td><b>Petak</b></td>
  <td><b>".$row['petak']."</b></td>
  </tr>
  <tr>

  </tbody>
  </table>
</div>

  ";
}
}

?>