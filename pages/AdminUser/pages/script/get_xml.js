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

            <a href="" onClick="triggerAddMod(this)"
            kat-idd='`+(isUndefined(id[i].childNodes[0]) ? id[i].childNodes[0].nodeValue : "")+`'
            style="position: relative; float: right; font-size: 20px; padding-right: 20px;"><i class='bx bx-message-alt-add'></i></a>
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

  var xml = new XMLHttpRequest();
  xml.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){

      let xmlFile = this.responseXML;
      let ime = xmlFile.getElementsByTagName("ime");
      let korisnicko_ime = xmlFile.getElementsByTagName("korisnicko_ime");
      let email = xmlFile.getElementsByTagName("email");
      let id = xmlFile.getElementsByTagName("id");

      function isUndefined(value){
        if(typeof value === 'undefined'){
          return false;
        }
        else return true;
      }

      for(let i=0; i< ime.length; i++){
        vijest = `
        <div class="recenzija">
              <h3>`+(isUndefined(ime[i].childNodes[0]) ? ime[i].childNodes[0].nodeValue : "")+`</h3>
              <span>`+(isUndefined(korisnicko_ime[i].childNodes[0]) ? korisnicko_ime[i].childNodes[0].nodeValue : "")+`</span>
              <p>`+(isUndefined(email[i].childNodes[0]) ? email[i].childNodes[0].nodeValue : "")+`</p>
              <form action"" method="POST">
                  <input type="hidden" name="ind"  id="ind" value='`+(isUndefined(id[i].childNodes[0]) ? id[i].childNodes[0].nodeValue : "")+`' required>
                  <button name='submit' style="float: right">Makni blokadu</button>
              </form>
        </div>
        `;
          section.innerHTML += vijest;
    }}}
    xml.open("GET","script/zak_kor_xml.php",true);
    xml.send();
}

function ucitajPodatkeVJRec(){
  let vijest;
  let section = document.querySelector(".section__rec");
  section.innerHTML = "";

  var xml = new XMLHttpRequest();
  xml.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){

      let xmlFile = this.responseXML;
      let naslov = xmlFile.getElementsByTagName("naslov");
      let autor = xmlFile.getElementsByTagName("autor");
      let kategorija = xmlFile.getElementsByTagName("kategorija");
      let id_vj = xmlFile.getElementsByTagName("id_vj");
      let id_kat = xmlFile.getElementsByTagName("id_kat");

      function isUndefined(value){
        if(typeof value === 'undefined'){
          return false;
        }
        else return true;
      }

      for(let i=0; i< naslov.length; i++){
        vijest = `
        <div class="recenzija">
              <h3>`+(isUndefined(naslov[i].childNodes[0]) ? naslov[i].childNodes[0].nodeValue : "")+`</h3>
              <p>`+(isUndefined(autor[i].childNodes[0]) ? autor[i].childNodes[0].nodeValue : "")+`</p>
              <p>`+(isUndefined(kategorija[i].childNodes[0]) ? kategorija[i].childNodes[0].nodeValue : "")+`</p>
              <form action"" method="POST">
                <button name='dodaj' style="float: right" onClick="triggerAddMod(this)"
                kat-id=`+(isUndefined(id_vj[i].childNodes[0]) ? id_vj[i].childNodes[0].nodeValue : "")+`
                vj-id=`+(isUndefined(id_kat[i].childNodes[0]) ? id_kat[i].childNodes[0].nodeValue : "")+`
                >Dodaj recenzenta</i></button>
              </form>
        </div>
        `;
          section.innerHTML += vijest;
      }}}
      xml.open("GET","script/vj_za_rec_xml.php",true);
      xml.send();
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
