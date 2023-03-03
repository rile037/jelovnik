<?php 
include "functions/init.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Izmeni jelovnik</title>
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

  <link rel='stylesheet' href='style.css'>
</head>
<body style='margin-top: 0px;'>
  <div class='main'>
    <div class='center'>
    <div class='container'>
      <?php 
      izmeni_jelovnik();?>

<div class='center' style='color: green; font-size: 20px; padding-top: 15px;'>
<?php display_message(); ?>
</div>
</div>
</div>
</body>
<script src='script.js'></script>
</html>