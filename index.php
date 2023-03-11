<?php 
include('inc/header.php');

?>
<?php
upisi_tekuci_jelovnik();
user_restriction();
?>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
  <title>Pocetna</title>
</head>
<body>
          <div class='main'>
            <?php proveri_datum();
?>
         
<div class='center'>
  <div class='container'>
    <?php if(izabraoJelovnik_iduci() == 1):?>
  <img src='assets/checked.png' style='width: 120px; height: 120px;'>
  <h3 style='margin-left: 15px;'>Izabrali ste jelovnik </h3>
  <form action='jelovnik.php'>
  <button class='btn' style='background-color: rgb(10,160,110);' type='submit'>Pogledaj jelovnik</button>
</form>
<?php else: ?>
  <img src='assets/cancel.png' style='width: 120px; height: 120px;'>
  <h3 style='margin-left: 15px;'>Niste izabrali jelovnik </h3>
  <form action='jelovnik.php'>
  <button class='btn' style='background-color: rgb(241,82,73);' type='submit'>Izaberite jelovnik</button>
</form>
<?php endif;?>
</div>
</div>
    </div>      
    </body>
  


<script src="script.js"></script>
