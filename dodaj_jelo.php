<?php
include('inc/header.php');
user_restriction();
upisi_jelovnik();
?>
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="bootstrap.min.css" />
  <script src="script.js"></script>
  <title>Dodaj jelo</title>
</head>
<body>
<div class='main' >
<div class="center">
  <div class='container'>
  <h3>30.01.2023 - 03.02.2023.</h3>
        <form method="POST" id='dodaj_jelo'>
          <br />

          <!--
          <input id="pon" type="text" name="pon" required />-->
          <label style='text-align: left;' for="pon">Ponedeljak:</label>
          <select name='pon' id='pon' form='dodaj_jelo'>
          <?php get_jelovnik(); ?>
          </select>
          <br />

          <label style="text-align: left;" for="uto">Utorak: </label>
          <select name='uto' id='uto' form='dodaj_jelo'>

          <?php get_jelovnik(); ?>
          </select>
          <br />

          <label style="text-align: left" for="sre">Sreda: </label>
          <select name='sre' id='sre' form='dodaj_jelo'>

          <?php get_jelovnik(); ?>
          </select>
          <br />

          <label style="text-align: left" for="cet">Cetvrtak: </label>
          <select name='cet' id='cet' form='dodaj_jelo'>

          <?php get_jelovnik(); ?>
          </select>
          <br />

          <label style="text-align: left" for="pet">Petak: </label>
          <select name='pet' id='pet' form='dodaj_jelo'>

          <?php get_jelovnik(); ?>
          </select>
          <br />

          <div style="padding-top: 25px" class="center">
            <input
              type="submit"
              class="btn"
              name="jelo-submit"
              placeholder="Postavi"
              value="Dodaj jelo"
            />
          </div>
        </form>
      </div>
</div>
    <div class='center' style='color: green; font-size: 20px; padding-top: 15px;'>

      <?php display_message(); ?>
      </div>

  </div>
</div>
</body>
