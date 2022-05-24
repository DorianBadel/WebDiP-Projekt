document.addEventListener("DOMContentLoaded", loadSve);

document.addEventListener('load', loadSve);

function loadSve(){

    let header_component = document.querySelector(".nav-list");
    let footer_component = document.getElementById("footer");

    header_component.innerHTML += loadHeader();

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

function loadHeader(){
    var html;
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
    `
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
