<?php 
include('../../functions/db.php');
if($_SERVER["REQUEST_METHOD"] == "GET")
{
  $ime = $_GET['ime'];
  $sql = "SELECT * FROM korisnik WHERE ime_prezime like '%".$ime."%'";
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