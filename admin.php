<?php 
include('inc/header.php');
user_restriction();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css" />
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
</head>
<body>
  <div class='main' style='padding-top: 0px;'>
    <div class='center'>
    <div class="row adminPodesavanja" style="margin-left: 0px;">

    <div class="col option" id="option1">
      <button class='btn' onClick="dodaj_jelo()">Dodaj jelo</button>
    </div>
    <div class="col option" id="option2">
      <form method='GET' id='2'>
      <button class='btn' type='submit'>Izlistaj sve zaposlene</button>
      </form>
    </div>
    <div class="col option" id="option3">
      <button class='btn' type='submit'">Podesavanje 2#</button>
    </div>
    <div class="col option" id="option4">
      <button class='btn' type='submit'>Podesavanje 3#</button>
    </div>
  </div>
</div><br>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div id="search-result">empty</div>
    <div class='center'>
</div>
  </div>

</div>

<div class="center">
  <div id="section" >
    Empty
</div>

</div>
</div>
  
</body>
</html>