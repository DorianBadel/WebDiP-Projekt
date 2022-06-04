function ucitajPodatke(){
  let vijest;
  let section = document.querySelector(".section__rec");
  section.innerHTML = "";

  var xml = new XMLHttpRequest();
  xml.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){

      let xmlFile = this.responseXML;
      let korisnik = xmlFile.getElementsByTagName("korisnik");
      let razlog = xmlFile.getElementsByTagName("razlog");

      function isUndefined(value){
        if(typeof value === 'undefined'){
          return false;
        }
        else return true;
      }

      for(let i=0; i< korisnik.length; i++){

          vijest = `
          <div class="recenzija">
                <h3>`+(isUndefined(korisnik[i].childNodes[0]) ? korisnik[i].childNodes[0].nodeValue : "")+`</h3>
                <p>`+(isUndefined(razlog[i].childNodes[0]) ? razlog[i].childNodes[0].nodeValue : "")+`</p>
            <a href="" blo-kor='`+(isUndefined(korisnik[i].childNodes[0]) ? korisnik[i].childNodes[0].nodeValue : "")+`'><i class='bx bx-edit'></i></a>
          </div>
          `;
          section.innerHTML += vijest;
    }}}
    xml.open("GET","script/blo_kor_xml.php",true);
    xml.send();
}

function ucitajPodatkeVJ(){
  let vijest;
  let section = document.querySelector(".section__rec");
  section.innerHTML = "";
  console.log("test1");

  $.ajax({url: "https://barka.foi.hr/WebDiP/2021_projekti/WebDiP2021x003/tablice/odb_vijesti.xml",
    type: "GET",
    dataType: "xml",
    success: function(result){
      $(result).find("xml blokiran").each(function(){
          vijest = `
          <div class="recenzija">
                <h3>`+($(this).find('naslov').text() || "Podatak ne postoji")+`</h3>
                <p>`+($(this).find('korisnik').text() || "Podatak ne postoji")+`</p>
                <span>`+($(this).find('datum_objave').text() || "Podatak ne postoji")+`</span>
            <a href=""><i class='bx bx-edit'></i></a>
          </div>
          `;
          section.innerHTML += vijest;
      })
    }
  });
}

function ucitajPodatkeMR(){
  let vijest;
  let section = document.querySelector(".section__news");
  section.innerHTML = "";

  $.ajax({url: "https://barka.foi.hr/WebDiP/2021_projekti/WebDiP2021x003/tablice/moje_rec.xml",
    type: "GET",
    dataType: "xml",
    success: function(result){
      $(result).find("xml vijest").each(function(){
          vijest = `
          <div class="news">

              <figure>
                <img src=`+$(this).find('slika').text()+` alt="Podatak ne postoji"
              </figure>
              <h3>`+($(this).find('naslov').text() || "Podatak ne postoji")+`</h3>
              <p>`+($(this).find('tekst').text() || "Podatak ne postoji")+`</p>
              <p>`+($(this).find('izvor').text() || "Podatak ne postoji")+`</p>
              <span>`+($(this).find('autori').text() || "Podatak ne postoji")+`</span>
              <span class="date">`+($(this).find('datum').text() || "Podatak ne postoji")+`</span>
              <p class="broj_pregleda">`+($(this).find('verzija').text() || "Podatak ne postoji")+`</p>
              <a href=""><i class='bx bx-edit-alt'></i></a>

          </div>
          `;

          section.innerHTML += vijest;
      })
    }
  });
}

$(document).ready(function(){
  console.log(document.title);

  if(document.title.match('Blokirani korisnici')){
    console.log("Spojen na blokirane korisnike");

    ucitajPodatke();
  }else if(document.title.match('Odbijene vijesti')){
    console.log("Spojen na odbijene vijesti");

    ucitajPodatkeVJ();
  }else if(document.title.match('Moje recenzije')){
    console.log("Spojen na moje recenzije");

    ucitajPodatkeMR();
  }else{
    console.log("error");
  }
});
