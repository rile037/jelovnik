<?php 
include('../../functions/db.php');
if($_SERVER["REQUEST_METHOD"] == "GET")
{
  $ime = $_GET['ime'];
  $sql = "SELECT * FROM korisnik INNER JOIN jelovnik ON korisnik.id_korisnika = jelovnik.id_korisnika 
  WHERE ime_prezime like '%".$ime."%'";
  $result = query($sql);
  while($row = $result -> fetch_assoc()){
    echo "
    <div class='center'>
    <table class='styled-table' id='pretraga_korisnika''>
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