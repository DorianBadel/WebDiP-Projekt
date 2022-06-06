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
                <h3>`+(isUndefined(naslov[i].childNodes[0]) ? naslov[i].childNodes[0].nodeValue : "")+`</h3>
                <p>`+(isUndefined(korisnik[i].childNodes[0]) ? korisnik[i].childNodes[0].nodeValue : "")+`</p>
                <span>`+(isUndefined(datum[i].childNodes[0]) ? datum[i].childNodes[0].nodeValue : "")+`</span>
            <a href="" onClick="triggerEditOdb(this)"
            odb-kor='`+(isUndefined(korisnik[i].childNodes[0]) ? korisnik[i].childNodes[0].nodeValue : "")+`';
            odb-kat='`+(isUndefined(kat[i].childNodes[0]) ? kat[i].childNodes[0].nodeValue : "")+`';
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

  var xml = new XMLHttpRequest();
  xml.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      let xmlFile = this.responseXML;

      let naslov = xmlFile.getElementsByTagName("naslov");
      let autori = xmlFile.getElementsByTagName("autori");
      let izvor = xmlFile.getElementsByTagName("izvor");
      let datum = xmlFile.getElementsByTagName("datum");
      let slika = xmlFile.getElementsByTagName("slika");
      let tekst = xmlFile.getElementsByTagName("tekst");
      let verzija = xmlFile.getElementsByTagName("verzija");

      function isUndefined(value){
        if(typeof value === 'undefined'){
          return false;
        }
        else return true;
      }

      for(let i=0; i< naslov.length; i++){
          vijest = `
          <div class="news">

              <figure>
                <img src=`+slika[i].childNodes[0].nodeValue+` alt="Podatak ne postoji"
              </figure>
              <h3>`+(isUndefined(naslov[i].childNodes[0]) ? naslov[i].childNodes[0].nodeValue : "Podatak ne postoji")+`</h3>
              <p>`+(isUndefined(tekst[i].childNodes[0]) ? tekst[i].childNodes[0].nodeValue : "Podatak ne postoji")+`</p>
              <p>`+(isUndefined(izvor[i].childNodes[0]) ? izvor[i].childNodes[0].nodeValue : "Podatak ne postoji")+`</p>
              <span>`+(isUndefined(autori[i].childNodes[0]) ? autori[i].childNodes[0].nodeValue  : "Podatak ne postoji")+`</span>
              <span class="date">`+(isUndefined(datum[i].childNodes[0]) ? datum[i].childNodes[0].nodeValue : "Podatak ne postoji")+`</span>
              <p class="broj_pregleda">`+(isUndefined(verzija[i].childNodes[0]) ? verzija[i].childNodes[0].nodeValue  : "Podatak ne postoji")+`</p>
              <a href=""><i class='bx bx-edit-alt'></i></a>

          </div>
          `;

          section.innerHTML += vijest;
    }}}
    xml.open("GET","script/moje_rec_xml.php",true);
    xml.send();
}

function ucitajPodatkeSTAT(){
  var table = $('#java_table').DataTable(
    {
      "aaSorting": [[1,"desc"]],
      "bPaginate":true,
      "bDeferRender": true
    }
  );

  var xml = new XMLHttpRequest();
  xml.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){

      let xmlFile = this.responseXML;
      let korisnik = xmlFile.getElementsByTagName("korisnik");
      let br_pr = xmlFile.getElementsByTagName("br_pr");
      let br_odb = xmlFile.getElementsByTagName("br_odb");

      for(let i=0; i< korisnik.length; i++){
          table.row.add([
            (korisnik[i].childNodes[0].nodeValue || "Podatak ne postoji"),
            (br_pr[i].childNodes[0].nodeValue || "Podatak ne postoji"),
            (br_odb[i].childNodes[0].nodeValue || "Podatak ne postoji"),
          ]).draw(false);
      }

      drawGraph(korisnik,br_pr,br_odb);

      function drawGraph(kor,prih,odb){
        let canv = document.getElementById("canvas");
        var cont = canv.getContext("2d");

        let TOP = 25;
        let LEFT = 55;

        let HEIGHT = canv.getAttribute('height')-110;
        let BOTTOM = HEIGHT+75;
        let WIDTH = canv.getAttribute('width')-100;
        let RIGHT = WIDTH+75;

        cont.clearRect(0,0,400,400);
        cont.fillStyle = 'red';

        cont.beginPath();
        cont.lineJoin = "round";
        cont.strokeStyle = "black";
        cont.moveTo(LEFT, TOP);
        cont.lineTo(LEFT,BOTTOM);
        cont.lineTo(RIGHT, BOTTOM);
        cont.lineTo(RIGHT, TOP);
        cont.lineTo(LEFT, TOP);
        cont.stroke();

        let barWidth = WIDTH/kor.length;
        let max = 0;
        for(let i=0; i< kor.length; i++){
          if(prih[i].childNodes[0].nodeValue > max) max = prih[i].childNodes[0].nodeValue;
          if (odb[i].childNodes[0].nodeValue > max) max = odb[i].childNodes[0].nodeValue;
        }

        let increment = (HEIGHT-TOP)/max;
        let offset = LEFT;

        cont.strokeStyle = "rgba(255,255,255,0.5)";
        for(let i = 0; i<= max; ++i){
          cont.beginPath();
          cont.moveTo(LEFT, HEIGHT-increment*i);
          cont.lineTo(RIGHT, HEIGHT-increment*i);
          cont.fillText(i,10,HEIGHT-increment*i);
          cont.stroke();
        }

        cont.strokeStyle = "black";

        for(let i=0; i< kor.length; i++){
          if(prih[i].childNodes[0].nodeValue != 0 || odb[i].childNodes[0].nodeValue != 0){
            cont.fillText(kor[i].childNodes[0].nodeValue,offset,BOTTOM+20);

            if(prih[i].childNodes[0].nodeValue != 0){
              cont.moveTo(offset, BOTTOM);
              cont.lineTo(offset,HEIGHT-increment*prih[i].childNodes[0].nodeValue);
              cont.lineTo(offset+barWidth,HEIGHT-increment*prih[i].childNodes[0].nodeValue);
              cont.lineTo(offset+barWidth,BOTTOM);

              cont.stroke();
            }

            offset += barWidth;



            if(odb[i].childNodes[0].nodeValue != 0){
              cont.moveTo(offset, BOTTOM);
              cont.lineTo(offset,HEIGHT-increment*odb[i].childNodes[0].nodeValue);
              cont.lineTo(offset+barWidth,HEIGHT-increment*odb[i].childNodes[0].nodeValue);
              cont.lineTo(offset+barWidth,BOTTOM);

              cont.stroke();
            }
            offset += barWidth;
          }
        }

      }




    }

  }
  xml.open("GET","script/rec_stat_xml.php",true);
  xml.send();

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
  }else if(document.title.match('Statistika o autorima')){
    console.log("Statistika o autorima");

    ucitajPodatkeSTAT();
  }else{
    console.log("error");
  }
});
