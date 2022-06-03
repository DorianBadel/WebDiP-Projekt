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
      let tmpStatus = xmlFile.getElementsByTagName("status");

      console.log(pregled[0].childNodes[0].nodeValue);


      for(let i=0; i< naslov.length; i++){
        if(tmpStatus[i].childNodes[0].nodeValue == 3)
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
      let naslov = xmlFile.getElementsByTagName("naslov");
      let slika = xmlFile.getElementsByTagName("slika");

      let tekst = xmlFile.getElementsByTagName("tekst");
      let izvor = xmlFile.getElementsByTagName("izvor");
      let autori = xmlFile.getElementsByTagName("autori");
      let video = xmlFile.getElementsByTagName("video");
      let audio = xmlFile.getElementsByTagName("audio");
      let pregledi = xmlFile.getElementsByTagName("pregledi");
      let tmpStatus = xmlFile.getElementsByTagName("status");
      let ID = xmlFile.getElementsByTagName("ID");
      let kateg= xmlFile.getElementsByTagName("kategorija");
      let status="";

      function isUndefined(value){
        if(typeof value === 'undefined'){
          return false;
        }
        else return true;
      }

      function isDorada(value,i){
        if(value === 'dorada'){
          let l = document.getElementById("status"+i);
          l.style.color = 'turquoise';
          let b = document.getElementById("btnRec"+i);
          b.innerHTML =`
          <a name="submit"  onClick="triggerMenu(this)"
          vj-name="`+(isUndefined(naslov[i].childNodes[0]) ? naslov[i].childNodes[0].nodeValue : "")+`"
          vj-tekst="`+(isUndefined(tekst[i].childNodes[0]) ? tekst[i].childNodes[0].nodeValue : "")+`"
          vj-autori="`+(isUndefined(autori[i].childNodes[0]) ? autori[i].childNodes[0].nodeValue : "")+`"
          vj-izvor="`+(isUndefined(izvor[i].childNodes[0]) ? izvor[i].childNodes[0].nodeValue : "")+`"
          vj-slika="`+(isUndefined(slika[i].childNodes[0]) ? slika[i].childNodes[0].nodeValue : "")+`"
          vj-zvuk="`+(isUndefined(audio[i].childNodes[0]) ? audio[i].childNodes[0].nodeValue : "")+`"
          vj-kateg="`+(isUndefined(kateg[i].childNodes[0]) ? kateg[i].childNodes[0].nodeValue : "")+`"
          vj-video="`+(isUndefined(video[i].childNodes[0]) ? video[i].childNodes[0].nodeValue : "")+`"
          vj-index="`+(isUndefined(ID[i].childNodes[0]) ? ID[i].childNodes[0].nodeValue : "")+`"
          vj-verzija="`+(isUndefined(tmpStatus[i].childNodes[0]) ? tmpStatus[i].childNodes[0].nodeValue : "")+`"
          ><i class='bx bx-edit'></i></a>
          `;

        }
      }

      for(let i=0; i<naslov.length; i++){

        switch(tmpStatus[i].childNodes[0].nodeValue){
          case '1': status="recenzija";
          break;
          case '2': status="dorada";
          break;
          case '3': status="prihvaceno";
          break;
          case '4': status="odbijeno";
          break;
        }

        let vijest = `
        <div class="news">

            <figure>
            <div class="testtt" id='btnRec`+i+`'></div>
              <img src=`+slika[i].childNodes[0].nodeValue+` alt="Podatak ne postoji"
            </figure>
            <a href="">
              <h3>`+(isUndefined(naslov[i].childNodes[0]) ? naslov[i].childNodes[0].nodeValue : "Podatak ne postoji")+`</h3>
              <p>`+(isUndefined(tekst[i].childNodes[0]) ? tekst[i].childNodes[0].nodeValue : "Podatak ne postoji")+`</p>
              <span>`+(isUndefined(autori[i].childNodes[0]) ? autori[i].childNodes[0].nodeValue  : "Podatak ne postoji")+`</span>
              <br><br>
              <span id='status`+i+`'>`+status+`</span>
              <p class="broj_pregleda">`+(isUndefined(pregledi[i].childNodes[0]) ? pregledi[i].childNodes[0].nodeValue  : "Podatak ne postoji")+`</p>
            </a>
        </div>
        `;
        section.innerHTML += vijest;
        isDorada(status,i);
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
      let greske_c = xmlFile.getElementsByTagName("greske_c");
      let greske_g = xmlFile.getElementsByTagName("greske_g");
      let nedostatak_ref = xmlFile.getElementsByTagName("nedostatak_ref");
      let nedostatak_mat = xmlFile.getElementsByTagName("nedostatak_mat");

      let vjTekst = xmlFile.getElementsByTagName("tekst");
      let vjAutori = xmlFile.getElementsByTagName("autori");
      let vjIzvor = xmlFile.getElementsByTagName("izvor");
      let vjSlika = xmlFile.getElementsByTagName("slika");
      let vjZvuk = xmlFile.getElementsByTagName("zvuk");
      let vjVideo = xmlFile.getElementsByTagName("video");
      let vjVerzija = xmlFile.getElementsByTagName("verzija")


      function isUndefined(value){
        if(typeof value === 'undefined'){
          return false;
        }
        else return true;
      }
      function isDorada(value,i){
        if(value === 'dorada'){
          let l = document.getElementById("status"+i);
          l.style.color = 'turquoise';
          let b = document.getElementById("btnRec"+i);
          b.innerHTML =`
          <button name="submit"  onClick="triggerMenu(this)"
          vj-name="`+(isUndefined(naslov[i].childNodes[0]) ? naslov[i].childNodes[0].nodeValue : "")+`"
          vj-tekst="`+(isUndefined(vjTekst[i].childNodes[0]) ? vjTekst[i].childNodes[0].nodeValue : "")+`"
          vj-autori="`+(isUndefined(vjAutori[i].childNodes[0]) ? vjAutori[i].childNodes[0].nodeValue : "")+`"
          vj-izvor="`+(isUndefined(vjIzvor[i].childNodes[0]) ? vjIzvor[i].childNodes[0].nodeValue : "")+`"
          vj-slika="`+(isUndefined(vjSlika[i].childNodes[0]) ? vjSlika[i].childNodes[0].nodeValue : "")+`"
          vj-zvuk="`+(isUndefined(vjZvuk[i].childNodes[0]) ? vjZvuk[i].childNodes[0].nodeValue : "")+`"
          vj-video="`+(isUndefined(vjVideo[i].childNodes[0]) ? vjVideo[i].childNodes[0].nodeValue : "")+`"
          vj-index="`+(isUndefined(ID[i].childNodes[0]) ? ID[i].childNodes[0].nodeValue : "")+`"
          vj-verzija="`+(isUndefined(vjVerzija[i].childNodes[0]) ? vjVerzija[i].childNodes[0].nodeValue : "")+`"
          style="float: right">Azuriraj vijest</button>
          `;
          return true;
        } else return false;
      }


      for(let i=0; i<naslov.length; i++){

        let vijest = `
        <div class="recenzija">
              <h3>`+(isUndefined(naslov[i].childNodes[0]) ? naslov[i].childNodes[0].nodeValue : "Podatak ne postoji")+`</h3>

              <br>
              <div> <strong> Komentar: </strong>  <sp>`+(isUndefined(komentar[i].childNodes[0]) ? komentar[i].childNodes[0].nodeValue : "")+`</p> </div>
              <div> <strong> Činjenične greške: </strong>  <sp>`+(isUndefined(greske_c[i].childNodes[0]) ? greske_c[i].childNodes[0].nodeValue : "")+`</p> </div>
              <div> <strong> Gramatičke greške: </strong>  <sp>`+(isUndefined(greske_g[i].childNodes[0]) ? greske_g[i].childNodes[0].nodeValue : "")+`</p> </div>
              <div> <strong> Nedostatak referenci: </strong>   <sp>`+(isUndefined(nedostatak_ref[i].childNodes[0]) ? nedostatak_ref[i].childNodes[0].nodeValue : "")+`</p> </div>
              <div> <strong> Nedostatak materijala: </strong>  <sp>`+(isUndefined(nedostatak_mat[i].childNodes[0]) ? nedostatak_mat[i].childNodes[0].nodeValue : "")+`</p> </div>



              <span id='status`+i+`'>`+(isUndefined(naziv_statusa[i].childNodes[0])  ? naziv_statusa[i].childNodes[0].nodeValue : "Podatak ne postoji")+`</span>
              <div class="testtt" id='btnRec`+i+`'></div>
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

  let xml = new XMLHttpRequest();
  xml.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){

      let xmlFile = this.responseXML;
      let kategorija = xmlFile.getElementsByTagName("kategorija");
      let blokiran_do = xmlFile.getElementsByTagName("blokiran_do");

      function isUndefined(value){
        if(typeof value === 'undefined'){
          return false;
        }
        else return true;
      }


      for(let i=0; i< kategorija.length; i++){
        table.row.add([
          (isUndefined(kategorija[i].childNodes[0]) ? kategorija[i].childNodes[0].nodeValue : "Podatak ne postoji"),
          (isUndefined(blokiran_do[i].childNodes[0]) ? blokiran_do[i].childNodes[0].nodeValue : "Podatak ne postoji")
        ]).draw(false);
      }

    }
  }
  xml.open("GET","script/auth_blo_kat_xml.php",true);
  xml.send();

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
