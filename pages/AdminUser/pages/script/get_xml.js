function ucitajPodatke(){
  let vijest;
  let section = document.querySelector(".section__rec");
  section.innerHTML = "";

  var xml = new XMLHttpRequest();
  xml.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){

      let xmlFile = this.responseXML;
      let naziv = xmlFile.getElementsByTagName("naziv");
      let sazetak = xmlFile.getElementsByTagName("sazetak");
      let opis = xmlFile.getElementsByTagName("opis");
      let id = xmlFile.getElementsByTagName("id");

      function isUndefined(value){
        if(typeof value === 'undefined'){
          return false;
        }
        else return true;
      }

      for(let i=0; i< naziv.length; i++){
          vijest = `
          <div class="recenzija">
                <h3>`+(isUndefined(naziv[i].childNodes[0]) ? naziv[i].childNodes[0].nodeValue : "")+`</h3>
                <span>`+(isUndefined(sazetak[i].childNodes[0]) ? sazetak[i].childNodes[0].nodeValue : "")+`</span>
                <p>`+(isUndefined(opis[i].childNodes[0]) ? opis[i].childNodes[0].nodeValue : "")+`</p>
            <a href="" onClick="triggerEditKat(this)"
            kat-naziv ='`+(isUndefined(naziv[i].childNodes[0]) ? naziv[i].childNodes[0].nodeValue : "")+`'
            kat-opis-short='`+(isUndefined(sazetak[i].childNodes[0]) ? sazetak[i].childNodes[0].nodeValue : "")+`'
            kat-opis-long='`+(isUndefined(opis[i].childNodes[0]) ? opis[i].childNodes[0].nodeValue : "")+`'
            kat-id='`+(isUndefined(id[i].childNodes[0]) ? id[i].childNodes[0].nodeValue : "")+`'
            ><i class='bx bx-edit'></i></a>

            <a href="" onClick="triggerAddMod(this)" style="position: relative; float: right; font-size: 20px; padding-right: 20px;"><i class='bx bx-message-alt-add'></i></a>
          </div>
          `;
          section.innerHTML += vijest;
    }}}
    xml.open("GET","script/kategorije_xml.php",true);
    xml.send();
}

function ucitajPodatkeZak(){
  let vijest;
  let section = document.querySelector(".section__rec");
  section.innerHTML = "";
  console.log("test1");

  $.ajax({url: "https://barka.foi.hr/WebDiP/2021_projekti/WebDiP2021x003/tablice/zak_kor.xml",
    type: "GET",
    dataType: "xml",
    success: function(result){
      $(result).find("xml zakljucan").each(function(){
        vijest = `
        <div class="recenzija">
              <h3>`+($(this).find('ime').text()+" "+$(this).find('prezime').text() || "Podatak ne postoji")+`</h3>
              <span>`+($(this).find('korisnicko_ime').text() || "Podatak ne postoji")+`</span>
              <p>`+($(this).find('email').text() || "Podatak ne postoji")+`</p>
          <a href="" style="float: right">Makni blokadu</i></a>
        </div>
        `;
          section.innerHTML += vijest;
      })
    }
  });
}

function ucitajPodatkeVJRec(){
  let vijest;
  let section = document.querySelector(".section__rec");
  section.innerHTML = "";

  $.ajax({url: "https://barka.foi.hr/WebDiP/2021_projekti/WebDiP2021x003/tablice/vj_za_rec.xml",
    type: "GET",
    dataType: "xml",
    success: function(result){
      $(result).find("xml vijest").each(function(){
        vijest = `
        <div class="recenzija">
              <h3>`+($(this).find('naslov').text()+" "+$(this).find('prezime').text() || "Podatak ne postoji")+`</h3>
              <p>`+($(this).find('autor').text() || "Podatak ne postoji")+`</p>
              <p>`+($(this).find('kategorija').text() || "Podatak ne postoji")+`</p>
          <a href="" style="float: right">Dodaj recenzenta</i></a>
        </div>
        `;
          section.innerHTML += vijest;
      })
    }
  });
}

$(document).ready(function(){
  console.log(document.title);

  if(document.title.match('Kategorije')){
    console.log("Spojen na Kategorije");

    ucitajPodatke();
  }else if(document.title.match('Zakljucani korisnici')){
    console.log("Spojen na Zakljucani korisnici");

    ucitajPodatkeZak();
  }else if(document.title.match('Vijesti za recenziju')){
    console.log("Spojen na Vijesti za recenziju");

    ucitajPodatkeVJRec();
  }else{
    console.log("error");
  }
});
