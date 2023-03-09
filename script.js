var modal;
var span;
var span2;
var text;
var text2;
var izmeni_korisnika_model;
var fileDialogDugme = document.getElementById("izaberiSliku");

let sveKolone = [
  "kolonaPon",
  "kolonaUto",
  "kolonaSre",
  "kolonaCet",
  "kolonaPet",
];

let jela = [];
let izabrana_tekuca_jela = [];
let izabrana_iduca_jela = [];

var adminSection = "";

function preventScroll(e){
  e.preventDefault();
  e.stopPropagation();

  return false;
}

function prikazi_jelovnik(id){
  switch (id){
    case "tekuci":
      var content_tekuci = document.getElementById('content-tekuci');
      var tekuci_btn = document.getElementById('tekuci');
      tekuci_btn.scrollIntoView({ behavior: "smooth" });
      content_tekuci.style.display = "block";
      tekuci_btn.style.backgroundColor = "#f44336";
      tekuci_btn.innerHTML = "Zatvori";
      tekuci_btn.setAttribute("onclick", "javascript: zatvori_jelovnik(this.id);");
      break;
    case "iduci":
      var content_iduci = document.getElementById('content-iduci')
      var iduci_btn = document.getElementById('iduci');
      content_iduci.style.display = "block";
      iduci_btn.scrollIntoView({ behavior: "smooth" });
      iduci_btn.style.backgroundColor = "#f44336";
      iduci_btn.innerHTML = "Zatvori";
      iduci_btn.setAttribute("onclick", "javascript: zatvori_jelovnik(this.id);");
      break;
}
}
function zatvori_jelovnik(id){
  switch(id){
    case "tekuci":
      var content_tekuci = document.getElementById('content-tekuci');
      var tekuci_btn = document.getElementById('tekuci');
      window.scrollTo({ top: 0, behavior: 'smooth' });
      content_tekuci.style.display = "none";
      tekuci_btn.style.backgroundColor = "rgb(10,160,110)";
      tekuci_btn.innerHTML = "Prikaži";
      tekuci_btn.setAttribute("onclick", "javascript: prikazi_jelovnik(this.id);");
    break;
    case "iduci":
      var content_iduci = document.getElementById('content-iduci')
      var iduci_btn = document.getElementById('iduci');
      window.scrollTo({ top: 0, behavior: 'smooth' });

      content_iduci.style.display = "none";
      iduci_btn.style.backgroundColor = "rgb(10,160,110)";
      iduci_btn.innerHTML = "Prikaži";
      iduci_btn.setAttribute("onclick", "javascript: prikazi_jelovnik(this.id);");
    break;
  }
  
}

$(document).ready(function () {

text = document.getElementById('search-result');
text2 = document.getElementById('search-result2');

modal = document.getElementById("myModal");
izmeni_korisnika_model = document.getElementById("izmeni_korisnika_modal");


// Get the button that opens the modal
// Get the <span> element that closes the modal
span = document.getElementsByClassName("close")[0];
span2 = document.getElementById("close2");


window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
  if (event.target == izmeni_korisnika_model) {
    izmeni_korisnika_model.style.display = "none";
  }
  if(event.target == span){
    modal.style.display = "none";
  }
  if(event.target == span2){
    izmeni_korisnika_model.style.display = "none";
  }
}

});

function izmeniKorisnika(el){
  let id = el.getAttribute("data-post_id");
  
  $.ajax({
    type: "GET",
    url: "ajax/admin/get_obrok_zaposlenog.php",
    dataType: "html",
    data: {id: id},
    success: function(response){
      
      text2.innerHTML = response;
      izmeni_korisnika_model.style.display = "block";
    }
  });
  
}

function sacuvaj() {
  let select0 = document.getElementById("iduci_pon").value;
  let select1 = document.getElementById("iduci_uto").value;
  let select2 = document.getElementById("iduci_sre").value;
  let select3 = document.getElementById("iduci_cet").value;
  let select4 = document.getElementById("iduci_pet").value;
  $.ajax({
    type: "POST",
    url: "ajax/update_obrok.php",
    data: { select0, select1, select2, select3, select4 },
    success: function (response) {
      window.location.replace("izmeni.php");
    }
  });
}

function open_file(){
  var dugme = document.getElementById('input_file');
  dugme.click();
  dugme.onchange = function(e){
    if (e.target.files[0]) {
      document.getElementById("save-button").hidden = false;
    }

  }

}

$(document).ready(function () {
  adminSection = document.getElementById('section'); 
  if(window.location.href.indexOf("izmeni") > -1)
  { 
  document.getElementById("iduci_pon").value = izabrana_iduca_jela[0];
  document.getElementById("iduci_uto").value = izabrana_iduca_jela[1];
  document.getElementById("iduci_sre").value = izabrana_iduca_jela[2];
  document.getElementById("iduci_cet").value = izabrana_iduca_jela[3];
  document.getElementById("iduci_pet").value = izabrana_iduca_jela[4];
  }
  
  $('#2').on('submit', function(e) {
      e.preventDefault();
$.ajax({
  type: "GET",
  url: "ajax/admin/izlistaj_sve_korisnike.php",
  dataType: "html",
  success: function(response){
    adminSection.innerHTML = response;
    var id = document.getElementsByName("izmeniKorisnika");
    id.onclick = function() {
      izmeniKorisnika(id);
  }
  
    $('#pretrazi_korisnika').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        type: "GET",
        url: "ajax/admin/pretrazi_korisnika.php",
        dataType: "html",
        data: {ime: $('#ime').val()},
        success: function(response){
          text.innerHTML = response;
          modal.style.display = "block";
          modal.addEventListener('wheel', preventScroll);
          
        }
      });
    

    });
  }
});
});

});

/* modal dialog */
// Get the modal

/**/ 


function dodaj_jelo(){
  adminSection.innerHTML = `
  <div class='container'>
  <div style='text-align: center; margin-top: 25px; margin-bottom: 15px;'>
    <h2>Dodajte novo jelo </h2>
  </div>
  <div>
    <form method='POST' class='center' id='1'>
      <input class='input' type='text' id='jelo' name='jelo' placeholder='Naziv jela...'><br>
      <button class='btn' type='submit'>Dodaj jelo</button>
    </form></div>`;
$('#1').on('submit', function(e) {
  $.ajax({
    type: "POST",
    url: "ajax/admin/dodaj_jelo.php",
    dataType: "html",
    data: {jelo: $('#jelo').val()},
    success: function(response){
      alert(response);
    }
  });
});
}
  



$.ajax({
  type: "GET",
  url: "ajax/get_obrok.php",
  dataType: "html",
  success: function (response) {
    let niz = response.split(",");
    for (i = 0; i < niz.length; i++) {
      jela.push(niz[i]);
    }
  },
});

$.ajax({
  type: "GET",
  url: "ajax/tekuca_nedelja/get_tekuci_jelovnik.php",
  dataType: "html",
  success: function (response) {
    let novi_niz = response.split(",");
    for (i = 0; i < novi_niz.length; i++) {
      izabrana_tekuca_jela.push(novi_niz[i]);
    }
  },
});


$.ajax({
  type: "GET",
  url: "ajax/iduca_nedelja/get_iduci_jelovnik.php",
  dataType: "html",
  success: function (response) {
    let novi_niz = response.split(",");
    for (i = 0; i < novi_niz.length; i++) {
      izabrana_iduca_jela.push(novi_niz[i]);
    }
  },
});

/*
function izmeni() {
  document
    .getElementById("update")
    .setAttribute("onclick", "javascript: sacuvaj();");
    

  izabrana_tekuca_jela.splice(-1);
  jela.splice(-1);
  for (let i = 0; i < sveKolone.length; i++) {
    document.getElementById(sveKolone[i]).innerHTML = "";
    var container = document.getElementById(sveKolone[i]);
    var formElement = document.createElement("select");
    sirina = document.getElementById('')
    formElement.style.width = "auto";
    formElement.style.marginRight = "0px";
    formElement.id = "" + i;
    for (var x = 0; x < jela.length; x++) {
      var opt = jela[x];
      var el = document.createElement("option");
      el.textContent = opt;
      el.value = opt;
      formElement.appendChild(el);
    }
    container.appendChild(formElement);
  }
  let dugme = document.getElementById("update");
  dugme.style.backgroundColor = "green";
  dugme.style.color = "White";
  dugme.innerHTML = "Sačuvaj";
  set_select();
}
function set_select() {
  document.getElementById("tekuci_pon").value = izabrana_tekuca_jela[0];
  document.getElementById("1").value = izabrana_tekuca_jela[1];
  document.getElementById("2").value = izabrana_tekuca_jela[2];
  document.getElementById("3").value = izabrana_tekuca_jela[3];
  document.getElementById("4").value = izabrana_tekuca_jela[4];
}

function sacuvaj() {
  let select0 = document.getElementById("0").value;
  let select1 = document.getElementById("1").value;
  let select2 = document.getElementById("2").value;
  let select3 = document.getElementById("3").value;
  let select4 = document.getElementById("4").value;
  $.ajax({
    type: "POST",
    url: "ajax/update_obrok.php",
    data: { select0, select1, select2, select3, select4 },
    success: function (response) {
      window.location.replace("index.php");
    },
  });
}*/
