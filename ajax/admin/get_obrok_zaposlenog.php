<?php 
include('../../functions/db.php');

if($_SERVER["REQUEST_METHOD"] == "GET"){
  $id = $_GET['id'];
  $sql = "SELECT * FROM korisnik WHERE id_korisnika = '$id'";
  $result = query($sql);
  while($row = $result -> fetch_assoc()){
    echo "
    <div class='center'>
  <table class='styled-table'>
  <thead>
    <tr>
      <th>".$row['id_korisnika']." - ".$row['ime_prezime']."</th>
      <th style='text-align: right; padding-right: 20px;'>
      <a href='#' onclick='izmeniKorisnika(this)' data-post_id='".$row['id_korisnika']."' id='izmeniKorisnika'>Izmeni</a>
      </th>
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
</div>";
  }
}


?>