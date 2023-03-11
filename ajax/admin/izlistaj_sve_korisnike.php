<?php 
include('../../functions/db.php');
if($_SERVER["REQUEST_METHOD"] == "GET"){


//$sql = "SELECT * FROM jelovnik";
//$result = query($sql);

$sql = "SELECT * FROM korisnik
INNER JOIN jelovnik ON korisnik.id_korisnika = jelovnik.id_korisnika";
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
      <th></th>
    
    </tr>
  </thead>
  <tbody>
  <tr>
  <td><b>Tekuci ponedeljak</b></td>
  <td><b>".$row['tekuci_pon']."</b></td>
  </tr>
  <tr>
  <td><b>Tekuci utorak</b></td>
  <td><b>".$row['tekuci_uto']."</b></td>
  </tr>
  <tr>
  <td><b>Tekuci sreda</b></td>
  <td><b>".$row['tekuci_sre']."</b></td>
  </tr>
  <tr>
  <td><b>Tekuci cetvrtak</b></td>
  <td><b>".$row['tekuci_cet']."</b></td>
  </tr>
  <tr>
  <td><b>Tekuci petak</b></td>
  <td><b>".$row['tekuci_pet']."</b></td>
  </tr>
  <tr>
  <td><b</b></td>
  </tr>

  <tr>
  <td><b>Iduci ponedeljak</b></td>
  <td><b>".$row['tekuci_pon']."</b></td>
  </tr>
  <tr>
  <td><b>Iduci utorak</b></td>
  <td><b>".$row['tekuci_uto']."</b></td>
  </tr>
  <tr>
  <td><b>Iduci sreda</b></td>
  <td><b>".$row['tekuci_sre']."</b></td>
  </tr>
  <tr>
  <td><b>Iduci cetvrtak</b></td>
  <td><b>".$row['tekuci_cet']."</b></td>
  </tr>
  <tr>
  <td><b>Iduci petak</b></td>
  <td><b>".$row['tekuci_pet']."</b></td>
  </tr>
  <tr>

  </tbody>
  </table>
</div>

  ";
}
}

?>
 
 <!--      <th style='text-align: right; padding-right: 20px;'>
      <a href='#' onclick='izmeniKorisnika(this)' data-post_id='".$row['id_korisnika']."' id='izmeniKorisnika'>Izmeni</a>
      
      </th>->>