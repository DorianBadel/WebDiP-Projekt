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
      let od = xmlFile.getElementsByTagName("blokiran_od");
      let doD = xmlFile.getElementsByTagName("blokiran_do");
      let kat = xmlFile.getElementsByTagName("naziv");

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
            <a href="" onClick="triggerEdit(this)"
            blo-kor='`+(isUndefined(korisnik[i].childNodes[0]) ? korisnik[i].childNodes[0].nodeValue : "")+`'
            blo-raz='`+(isUndefined(razlog[i].childNodes[0]) ? razlog[i].childNodes[0].nodeValue : "")+`'
            blo-od='`+(isUndefined(od[i].childNodes[0]) ? od[i].childNodes[0].nodeValue : "")+`'
            blo-do='`+(isUndefined(doD[i].childNodes[0]) ? doD[i].childNodes[0].nodeValue : "")+`'
            blo-kat='`+(isUndefined(kat[i].childNodes[0]) ? kat[i].childNodes[0].nodeValue : "")+`'
            >
            <i class='bx bx-edit'></i></a>
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

  var xml = new XMLHttpRequest();
  xml.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){

      let xmlFile = this.responseXML;
      let korisnik = xmlFile.getElementsByTagName("korisnik");
      let datum = xmlFile.getElementsByTagName("datum_objave");
      let kat = xmlFile.getElementsByTagName("naziv");
      let naslov = xmlFile.getElementsByTagName("naslov");

      function isUndefined(value){
        if(typeof value === 'undefined'){
          return false;
        }
        else return true;
      }


      for(let i=0; i< korisnik.length; i++){
          vijest = `
          <div class="recenzija">
                <h3>`+isUndefined(naslov[i].childNodes[0]) ? naslov[i].childNodes[0].nodeValue : "")+`</h3>
                <p>`+isUndefined(korisnik[i].childNodes[0]) ? korisnik[i].childNodes[0].nodeValue : "")+`</p>
                <span>`+isUndefined(datum[i].childNodes[0]) ? datum[i].childNodes[0].nodeValue : "")+`</span>
            <a href=""
            odb-kor='`+isUndefined(korisnik[i].childNodes[0]) ? korisnik[i].childNodes[0].nodeValue : "")+`';
            odb-kat='`+isUndefined(kat[i].childNodes[0]) ? kat[i].childNodes[0].nodeValue : "")+`';

            ><i class='bx bx-edit'></i></a>
          </div>
          `;
          section.innerHTML += vijest;
  }}}
  xml.open("GET","script/odb_vijest_xml.php",true);
  xml.send();
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
