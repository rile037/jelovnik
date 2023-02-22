<?php include('inc/header.php');?>

<?php
upisi_jelovnik();
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
          <div class='center'>
            <div>
          <?php get_jelo(); 
          check_jelovnik();
          ?>    
</div>
    </div>      
  </div>

</div>
    </body>
  


<script src="script.js"></script>
