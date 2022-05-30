document.addEventListener("DOMContentLoaded", loadSve);

document.addEventListener('load', loadSve);

function loadSve(){


    let footer_component = document.getElementById("footer");

    srcUloga();

    //console.log(srcUloga())

    //footer_component.innerHTML += loadFooter();


// get links depending on page. so current location (index.html,whatever.html...);
};


function getLocationLinks(){
    var links= [];
    var loc = window.location.pathname.split('/');
    var path = loc[loc.length-1];
    console.log(loc[loc.length-1]);


    if(path == "" || path == "index.php" ){
      links.push("pages/User/Galerija_vijesti.php");
      links.push("pages/User/o_autoru.php");
      links.push("pages/User/dokumentacija.php");
      links.push("pages/User/Rang_lista.php");
    }else if(

      path == "prijava.php" ||
      path == "registracija.php" ||
      path == "Galerija_vijesti.php" ||
      path == "o_autoru.php" ||
      path == "Rang_lista.php" ||
      path == "dokumentacija.php"
     ){
      links.push("Galerija_vijesti.php");
      links.push("o_autoru.php");
      links.push("dokumentacija.php");
      links.push("Rang_lista.php");
    }

    return links;
};

function getLocationLinksAuth(){
    var links= [];
    var loc = window.location.pathname.split('/');
    var path = loc[loc.length-1];
    console.log(loc[loc.length-1]);

    if(path == "" || path == "index.php" ){
      links.push("pages/RegUser/pocetna.php");
      links.push("pages/RegUser/Radni_prostor.php");
    }else if(

      path == "prijava.php" ||
      path == "registracija.php" ||
      path == "Galerija_vijesti.php" ||
      path == "o_autoru.php" ||
      path == "Rang_lista.php" ||
      path == "dokumentacija.php"
     ){
      links.push("../RegUser/pocetna.php");
      links.push("../RegUser/Radni_prostor.php");
    }
    else if(path == "pocetna.php"){
      links.push("#");
      links.push("Radni_prostor.php");
    }
    else if(path == "Radni_prostor.php"){
      links.push("pocetna.php");
      links.push("#");
    }
    else if(
      path == "auth_stat.php" ||
      path == "blo_kat.php" ||
      path == "moj_recenzije.php" ||
      path == "moj_vijesti.php"
    ){
      links.push("../pocetna.php");
      links.push("../Radni_prostor.php");
    }

    return links;
};

function getLocationLinksRec(){
  var links= [];
  var loc = window.location.pathname.split('/');
  var path = loc[loc.length-1];
  console.log(loc[loc.length-1]);

  if(path == "" || path == "index.php" ){
    links.push("pages/RegUser/pocetna.php");
    links.push("pages/RegUser/Radni_prostor.php");
    links.push("pages/ModUser/Urednicki_prostor.php");
  }else if(
    path == "prijava.php" ||
    path == "registracija.php" ||
    path == "Galerija_vijesti.php" ||
    path == "o_autoru.php" ||
    path == "Rang_lista.php" ||
    path == "dokumentacija.php"
   ){
    links.push("../RegUser/pocetna.php");
    links.push("../RegUser/Radni_prostor.php");
    links.push("../ModUser/Urednicki_prostor.php");
  }
  else if(path == "pocetna.php"){
    links.push("#");
    links.push("Radni_prostor.php");
    links.push("../ModUser/Urednicki_prostor.php");
  }
  else if(path == "Radni_prostor.php"){
    links.push("pocetna.php");
    links.push("#");
    links.push("../ModUser/Urednicki_prostor.php");
  }
  else if(path == "Urednicki_prostor.php"){
    links.push("../RegUser/pocetna.php");
    links.push("../RegUser/Radni_prostor.php");
    links.push("#");
  }
  else if(
    path == "auth_stat.php" ||
    path == "blo_kat.php" ||
    path == "moj_recenzije.php" ||
    path == "moj_vijesti.php"
  ){
    links.push("../pocetna.php");
    links.push("../Radni_prostor.php");
    links.push("../../ModUser/Urednicki_prostor.php");
  }
  else if(
    path == "blo_kor.php" ||
    path == "moj_recenzije.php" ||
    path == "odb_vijesti.php" ||
    path == "rec_stat.php"
  ){
    links.push("../../RegUser/pocetna.php");
    links.push("../../RegUser/Radni_prostor.php");
    links.push("../ModUser/Urednicki_prostor.php");
  }

  return links;
}


function loadHeader(value){
    var html;
    let links;

    switch(value){
      case 0: //Neregistriran korisnik
        links = getLocationLinks();
        html= `
          <li>
            <a href="`+links[0]+`">
              <i class='bx bx-grid-alt'></i>
            </a>
             <span class="tooltip">Pregled Vijesti</span>
          </li>
          <li>
           <a href="`+links[1]+`">
             <i class='bx bx-user' ></i>
           </a>
           <span class="tooltip">O autoru</span>
         </li>
         <li>
           <a href="`+links[2]+`">
             <i class='bx bxs-file-doc' ></i>
           </a>
           <span class="tooltip">Dokumentacija</span>
         </li>
         <li>
           <a href="`+links[3]+`">
             <i class='bx bx-list-ol' ></i>
           </a>
           <span class="tooltip">Rang lista</span>
         </li>
        `;
      break;
      case 1: //Registriran korisnik
        links = getLocationLinksAuth();
        html =`
        <li>
          <a href="`+links[0]+`">
            <i class='bx bx-windows'></i>
          </a>
           <span class="tooltip">Početna</span>
        </li>
        <li>
          <a href="`+links[1]+`">
            <i class='bx bx-coffee'></i>
          </a>
           <span class="tooltip">Radni prostor</span>
        </li>
        `;

      break;
      case 2: //urednik
        links = getLocationLinksRec();
        html = `
          <li>
            <a href="`+links[0]+`">
              <i class='bx bx-windows'></i>
            </a>
             <span class="tooltip">Početna</span>
          </li>
          <li>
            <a href="`+links[1]+`">
              <i class='bx bx-coffee'></i>
            </a>
             <span class="tooltip">Radni prostor</span>
          </li>
          <li>
            <a href="`+links[2]+`">
              <i class='bx bx-pen'></i>
            </a>
             <span class="tooltip">Urednicki prostor</span>
          </li>
        `;
      break;
      case 3: //admin

      break;
    } //switch

    return html;
};

function loadFooter(){
    var html;
    html = `
    <div class="footer">
      <address>
        <p> <a href="mailto:dbadel@foi.hr"> Dorian Badel</a> &copy; 2022.</p>
      </address>
      <div class="footer_icons">
        <!--<a href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2021/zadaca_02/dbadel/index.php" class="footer_icon-html">
          <img src="materijali/HTML5.png" alt="HTML validator">
        </a>
        <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2021/zadaca_02/dbadel/index.php" class="footer_icon-html">
          <img src="materijali/CSS3.png" alt="CSS validator">
        </a>-->
      </div>
    </div>
    `;
    return html;
};

function test(test){
  console.log(test);
  let header_component = document.querySelector(".nav-list");
  //test = "3";
  switch(test){
    case "2":
      header_component.innerHTML += loadHeader(1);
    break;
    case "3":
      header_component.innerHTML += loadHeader(2);
    break;
    case "4":
      header_component.innerHTML += loadHeader(3);
    break;
    default:
      header_component.innerHTML += loadHeader(0);
  }
}

function srcUloga(){
  console.log("test");
  let vr = [];
  $.ajax({url: 'https://barka.foi.hr/WebDiP/2021_projekti/WebDiP2021x003/role.xml',
    type: 'GET',
    dataType: 'xml',
    success: function(result){
      $(result).find('xml korisnik').each(function(){
          vr["ul"] = $(this).find('uloga').text();

          test(vr["ul"]);
      })
      }
    })
  }
