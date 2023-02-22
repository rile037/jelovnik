var modal;
var span;
var span2;
var text;
var text2;
var izmeni_korisnika_model;

let sveKolone = [
  "kolonaPon",
  "kolonaUto",
  "kolonaSre",
  "kolonaCet",
  "kolonaPet",
];

let jela = [];
let izabrana_jela = [];

var adminSection = "";

function preventScroll(e){
  e.preventDefault();
  e.stopPropagation();

  return false;
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

// When the user clicks on <span> (x), close the modal

// When the user clicks anywhere outside of the modal, close it
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




$(document).ready(function () {
  adminSection = document.getElementById('section');  
  
  $('#2').on('submit', function(e) {
      e.preventDefault();
$.ajax({
  type: "GET",
  url: "ajax/admin/izlistaj_sve_korisnike.php",
  dataType: "html",
  success: function(response){
    adminSection.innerHTML = response;
    document.getElementById("izmeniKorisnika").onclick = function() {
      var id = document.getElementById('izmeniKorisnika').value;
      var submit = document.getElementById("izmeni_korisnika");
      $(submit).on('click', function(e) {
        e.preventDefault();
        alert(id);
        /*$.ajax({
          type: "get",
          url: "ajax/admin/get_obrok_zaposlenog.php",
          dataType: "html",
          success: function(response){
            alert(response);
          }
        });*/
        text2.innerHTML = 
        izmeni_korisnika_model.style.display = "block";
      });
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

$("click").click(function () {
  $("html,body").animate(
    {
      scrollTop: $(".login").offset().top,
    },
    "slow"
  );
});

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
  url: "ajax/get_jela.php",
  dataType: "html",
  success: function (response) {
    let novi_niz = response.split(",");
    for (i = 0; i < novi_niz.length; i++) {
      izabrana_jela.push(novi_niz[i]);
    }
  },
});

function izmeni() {
  document
    .getElementById("update")
    .setAttribute("onclick", "javascript: sacuvaj();");
    

  izabrana_jela.splice(-1);
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
  document.getElementById("0").value = izabrana_jela[0];
  document.getElementById("1").value = izabrana_jela[1];
  document.getElementById("2").value = izabrana_jela[2];
  document.getElementById("3").value = izabrana_jela[3];
  document.getElementById("4").value = izabrana_jela[4];
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
}
