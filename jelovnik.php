<?php
include('inc/header.php');
user_restriction();
upisi_tekuci_jelovnik();
upisi_iduci_jelovnik();

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
<div class='main' style='height: auto;'>
<div class='center' style='color: green; font-size: 20px; '>

<?php display_message(); ?>
</div>
<div class="center">
  
<div class='row'>
  <div class='col' style='height: 1000px;'>
    <div class='center' style='margin-bottom: 7px;'>
    

  </div>
    <div class='container' style='height: auto;'>
    <h3 id='tekuci-naslov' style='margin-top: 6px;'>Tekuća nedelja</h3>
      <?php tekuca_nedelja();?>
      <hr>
      <?php if(izabraoJelovnik_tekuci() == 0):?>
        <img src='assets/cancel.png' style='width: 120px; height: 120px;'>

      <form method="POST" id='upisi_tekuci_jelovnik'>
                <br />
      
                <!--
                <input id="pon" type="text" name="pon" required />-->
                <label style='text-align: left;' for="tekuci_pon">Ponedeljak:</label>
                <select name='tekuci_pon' id='tekuci_pon' form='upisi_tekuci_jelovnik' >
                <?php get_obrok(); ?>
                </select>
                <br />
      
                <label style="text-align: left;" for="tekuci_uto">Utorak: </label>
                <select name='tekuci_uto' id='tekuci_uto' form='upisi_tekuci_jelovnik'>
      
                <?php get_obrok(); ?>
                </select>
                <br />
      
                <label style="text-align: left" for="tekuci_sre">Sreda: </label>
                <select name='tekuci_sre' id='tekuci_sre' form='upisi_tekuci_jelovnik'>
      
                <?php get_obrok(); ?>
                </select>
                <br />
      
                <label style="text-align: left" for="tekuci_cet">Cetvrtak: </label>
                <select name='tekuci_cet' id='tekuci_cet' form='upisi_tekuci_jelovnik'>
      
                <?php get_obrok(); ?>
                </select>
                <br />
      
                <label style="text-align: left" for="tekuci_pet">Petak: </label>
                <select name='tekuci_pet' id='tekuci_pet' form='upisi_tekuci_jelovnik'>
      
                <?php get_obrok(); ?>
                </select>
                <br />
      
                <div style="padding-top: 25px" class="center">
                  <input
                    type="submit"
                    class="btn"
                    name="tekuca_nedelja"
                    placeholder="Postavi"
                    value="Upisi jelovnik"
                  />
                </div>
              </form>
              <?php else: ?>
                <img src='assets/checked.png' alt='uspesno ste izabrali jelovnik' width='175px' height='176px' style='margin-top: 20px;'/>
                
                <p style='margin-top: 25px; font-size: 25px;'>Izabrali ste jelovnik za <span style='font-weight: bold;'>tekuću</span> nedelju.</p>

                <button class='btn' id='tekuci' style='background-color: rgb(10,160,110);' onClick="prikazi_jelovnik(this.id)">Prikaži</button>

                <?php endif;?>
          
    </div>
    <div id='content-tekuci'>
                    <?php get_tekuci_jelovnik(); ?>
              </div>
  </div>
  <div class='col' style='height: 1000px;'>
  <div class='center' style='margin-bottom: 7px;'></div>

  <div class='container' style='height: auto;'>
  <h3 id='iduca-naslov' style='margin-top: 6px;'>Iduća nedelja</h3>
    
        <?php iduca_nedelja();?>
        <hr>
        <?php if(izabraoJelovnik_iduci() == 0):?>
          <img src='assets/cancel.png' style='width: 120px; height: 120px;'>

        <form method="POST" id='upisi_iduci_jelovnik'>
                <br />
      
                <!--
                <input id="pon" type="text" name="pon" required />-->
                <label style='text-align: left;' for="iduci_pon">Ponedeljak:</label>
                <select name='iduci_pon' id='iduci_pon' form='upisi_iduci_jelovnik'>
                <?php get_obrok(); ?>
                </select>
                <br />
      
                <label style="text-align: left;" for="iduci_uto">Utorak: </label>
                <select name='iduci_uto' id='iduci_uto' form='upisi_iduci_jelovnik'>
      
                <?php get_obrok(); ?>
                </select>
                <br />
      
                <label style="text-align: left" for="iduci_sre">Sreda: </label>
                <select name='iduci_sre' id='iduci_sre' form='upisi_iduci_jelovnik'>
      
                <?php get_obrok(); ?>
                </select>
                <br />
      
                <label style="text-align: left" for="iduci_cet">Cetvrtak: </label>
                <select name='iduci_cet' id='iduci_cet' form='upisi_iduci_jelovnik'>
      
                <?php get_obrok(); ?>
                </select>
                <br />
      
                <label style="text-align: left" for="iduci_pet">Petak: </label>
                <select name='iduci_pet' id='iduci_pet' form='upisi_iduci_jelovnik'>
      
                <?php get_obrok(); ?>
                </select>
                <br />
      
                <div style="padding-top: 25px" class="center">
                  <input
                    type="submit"
                    class="btn"
                    name="iduca_nedelja"
                    placeholder="Postavi"
                    value="Upisi jelovnik"
                  />
                </div>
              </form>
              <?php else: ?>
                <img src='assets/checked.png' alt='uspesno ste izabrali jelovnik' width='175px' height='176px' style='margin-top: 20px;'/>
                
                <p style='margin-top: 25px; font-size: 25px;'>Izabrali ste jelovnik za <span style='font-weight: bold;'>iduću</span> nedelju.</p>
                <button class='btn' id='iduci' style='background-color: rgb(10,160,110);' onClick="prikazi_jelovnik(this.id)">Prikaži</button>

                <?php endif;?>
            </div>
            <div id='content-iduci'>
                    <?php get_iduci_jelovnik(); ?>
              </div>
  </div>
      </div>
</div>
</div>
    
  </div>
</div>
</body>
