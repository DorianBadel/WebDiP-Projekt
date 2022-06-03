function ucitajPodatke(){

  var table = $('#java_table').DataTable(
    {
      "aaSorting": [[0,"desc"]],
      "bPaginate":true,
      "bDeferRender": true
    }
  );

  var xml = new XMLHttpRequest();
  xml.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){

      let xmlFile = this.responseXML;
      let pregled = xmlFile.getElementsByTagName("pregledi");
      let naslov = xmlFile.getElementsByTagName("naslov");
      let autori = xmlFile.getElementsByTagName("autori");
      let datum = xmlFile.getElementsByTagName("datum");
      console.log(pregled[0].childNodes[0].nodeValue);


      for(let i=0; i< naslov.length; i++){
        table.row.add([
          (pregled[i].childNodes[0].nodeValue || "Podatak ne postoji"),
          (naslov[i].childNodes[0].nodeValue || "Podatak ne postoji"),
          (autori[i].childNodes[0].nodeValue || "Podatak ne postoji"),
          (datum[i].childNodes[0].nodeValue || "Podatak ne postoji")
        ]).draw(false);
      }

    }
  }
  xml.open("GET","script/auth_stat.php",true);
  xml.send();

}

function ucitajPodatkeVijest(){
  let vijest;
  let section = document.querySelector(".section__news");
  section.innerHTML = "";

  var xml = new XMLHttpRequest();
  xml.onreadystatechange = function (){
    if(this.readyState == 4 && this.status == 200){
      let xmlFile = this.responseXML;
      let slika = xmlFile.getElementsByTagName("slika");
      let naslov = xmlFile.getElementsByTagName("naslov");
      let tekst = xmlFile.getElementsByTagName("tekst");
      let autori = xmlFile.getElementsByTagName("autori");
      let pregledi = xmlFile.getElementsByTagName("pregledi");


      for(let i=0; i<naslov.length; i++){
        let vijest = `
        <div class="news">

            <figure>
              <a href=""> <i class='bx bx-edit'></i> </a>
              <img src=`+slika[i].childNodes[0].nodeValue+` alt="Podatak ne postoji"
            </figure>
            <a href="">
              <h3>`+(naslov[i].childNodes[0].nodeValue || "Podatak ne postoji")+`</h3>
              <p>`+(tekst[i].childNodes[0].nodeValue || "Podatak ne postoji")+`</p>
              <span>`+(autori[i].childNodes[0].nodeValue  || "Podatak ne postoji")+`</span>
              <p class="broj_pregleda">`+(pregledi[i].childNodes[0].nodeValue  || "Podatak ne postoji")+`</p>
            </a>
        </div>
        `;
        section.innerHTML += vijest;
        }
    }
  }
  xml.open("GET","script/auth_stat.php",true);
  xml.send();
}

function ucitajPodatkeRec(){
  let vijest;
  let section = document.querySelector(".section__rec");
  section.innerHTML = "";

  var xml = new XMLHttpRequest();
  xml.onreadystatechange = function (){
    if(this.readyState == 4 && this.status == 200){
      let xmlFile = this.responseXML;
      let naslov = xmlFile.getElementsByTagName("naslov");
      let komentar = xmlFile.getElementsByTagName("komentar");
      let naziv_statusa = xmlFile.getElementsByTagName("naziv_statusa");
      let ID = xmlFile.getElementsByTagName("ID");

      if(typeof komentar[0].childNodes[0] === 'undefined') console.log('undef'); else console.log('defdef');

      function isUndefined(value){
        if(typeof value === 'undefined'){
          return false;
        }
        else return true;
      }
      function isDorada(value,i){
        if(value === 'dorada'){
          let l = document.getElementById("status");
          l.style.color = 'purple';
          let b = document.getElementById("btnRec");
          b.innerHTML =`
          <button name="submit"  onClick="triggerMenu(this)"
          vj-name="`+naslov[i].childNodes[0].nodeValue+`">`+ID[i].childNodes[0].nodeValue+`</button>
          `;

          //createEditForm();
          return true;
        } else return false;
      }


      for(let i=0; i<naslov.length; i++){

        let vijest = `
        <div class="recenzija">
              <h3>`+(isUndefined(naslov[i].childNodes[0]) ? naslov[i].childNodes[0].nodeValue : "Podatak ne postoji")+`</h3>
              <p>`+(isUndefined(komentar[i].childNodes[0]) ? komentar[i].childNodes[0].nodeValue : "Podatak ne postoji")+`</p>
              <span id="status">`+(isUndefined(naziv_statusa[i].childNodes[0])  ? naziv_statusa[i].childNodes[0].nodeValue : "Podatak ne postoji")+`</span>
              <div id="btnRec"></div>
        </div>
        `;
        section.innerHTML += vijest;
        isDorada(naziv_statusa[i].childNodes[0].nodeValue,i);
        }
    }
  }
  xml.open("GET","script/moj_recenzije_xml.php",true);
  xml.send();

}

function ucitajPodatkeBlokKat(){
  var table = $('#java_table').DataTable(
    {
      "aaSorting": [[0,"desc"]],
      "bPaginate":true,
      "bDeferRender": true
    }
  );

  $.ajax({url: "https://barka.foi.hr/WebDiP/2021_projekti/WebDiP2021x003/tablice/auth_blo_kat.xml",
    type: "GET",
    dataType: "xml",
    success: function(result){
      $(result).find("xml blokiran").each(function(){
          table.row.add([
          ($(this).find('kategorija').text() || "Podatak ne postoji"),
          ($(this).find('blokiran_do').text() || "Podatak ne postoji")
          ]).draw(false);

      })
    }
  });

}

$(document).ready(function(){
  console.log(document.title);

  if(document.title.match('Statistika autora')){
    console.log("Spojen na statistiku autora");

    ucitajPodatke();
  }else if(document.title.match('Moje objave')){
    console.log("Spojen na moje objave");

    ucitajPodatkeVijest();
  }else if(document.title.match('Moje recenzije')){
    console.log("Spojen na moje recenzije");

    ucitajPodatkeRec();
  }else if(document.title.match('Blokirane kategorije')){
    console.log("Spojen na blokirane kategorije");

    ucitajPodatkeBlokKat();

  }else{
    console.log("error");
  }
});
