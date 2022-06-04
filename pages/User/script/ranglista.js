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
      let izvor = xmlFile.getElementsByTagName("izvor");
      let datum = xmlFile.getElementsByTagName("datum");
      let tmpStatus = xmlFile.getElementsByTagName("status");

      function isUndefined(value){
        if(typeof value === 'undefined'){
          return false;
        }
        else return true;
      }



      for(let i=0; i< naslov.length; i++){
        if(tmpStatus[i].childNodes[0].nodeValue == 3)
          table.row.add([
            (isUndefined(pregled[i].childNodes[0]) ? pregled[i].childNodes[0].nodeValue : "Podatak ne postoji"),
            (isUndefined(naslov[i].childNodes[0]) ? naslov[i].childNodes[0].nodeValue : "Podatak ne postoji"),
            (isUndefined(autori[i].childNodes[0]) ? autori[i].childNodes[0].nodeValue : "Podatak ne postoji"),
            (isUndefined(izvor[i].childNodes[0]) ? izvor[i].childNodes[0].nodeValue : "Podatak ne postoji"),
            (isUndefined(datum[i].childNodes[0]) ? datum[i].childNodes[0].nodeValue : "Podatak ne postoji")
          ]).draw(false);
      }
    }}
    xml.open("GET","script/rang_lista_xml.php",true);
    xml.send();
}

function ucitajPodGal(){
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
      let autori = xmlFile.getElementsByTagName("autori");
      let pregledi = xmlFile.getElementsByTagName("pregledi");

      function isUndefined(value){
        if(typeof value === 'undefined'){
          return false;
        }
        else return true;
      }

      for(let i=0; i<naslov.length; i++){
        vijest = `
          <div class="news">
            <a href="">
              <figure>
                <img src=`+slika[i].childNodes[0].nodeValue+` alt="Podatak ne postoji">
              </figure>
              <h3>`+(isUndefined(naslov[i].childNodes[0]) ? naslov[i].childNodes[0].nodeValue : "Podatak ne postoji")+`</h3>
              <p>`+(isUndefined(tekst[i].childNodes[0]) ? tekst[i].childNodes[0].nodeValue : "Podatak ne postoji")+`</p>
              <span>`+(isUndefined(autori[i].childNodes[0]) ? autori[i].childNodes[0].nodeValue  : "Podatak ne postoji")+`</span>
              <p class="broj_pregleda">`+(isUndefined(pregledi[i].childNodes[0]) ? pregledi[i].childNodes[0].nodeValue  : "Podatak ne postoji")+`</p>
            </a>
          </div>
          `;

          section.innerHTML += vijest;
        }
      }
    }
    xml.open("GET","script/rang_lista_xml.php",true);
    xml.send();

}

$(document).ready(function(){
  console.log(document.title);

  if(document.title.match('Rang lista vijesti')){
    console.log("Spojen na ranglistu");
    ucitajPodatke();
  }else if (document.title.match('Galerija vijesti')){
    console.log("Spojen na galeriju");
    ucitajPodGal();
  }else{
    console.log("error");
  }
});
