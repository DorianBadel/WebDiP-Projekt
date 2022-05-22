document.addEventListener("DOMContentLoaded", loadSve);

document.addEventListener('load', loadSve);

function loadSve(){
    var logedIn = false;


    let header_component = document.querySelector(".nav-list");
    let footer_component = document.getElementById("footer");

    header_component.innerHTML += loadHeader();
    var logIn = document.querySelector(".profile-details");
    links = getLocationLinks();
    if(!logedIn){
      logIn.innerHTML = `<a href="`+links[4]+`"><i class='bx bx-log-in' id='log_out'></i></a>`
    } else {
      logIn.innerHTML = "<a ><i class='bx bx-log-out' id='log_out'></i></a>"
    }

    footer_component.innerHTML = loadFooter();


// get links depending on page. so current location (index.html,whatever.html...);
};

function getLocationLinks(){
    var links= [];
    var loc = window.location.pathname;
    console.log(loc);


    if(loc== "/index.html"){
      links.push("pages/User/Galerija_vijesti.html");
      links.push("pages/User/o_autoru.html");
      links.push("pages/User/dokumentacija.html");
      links.push("pages/User/Rang_lista.html");
      links.push("pages/User/prijava.html")
    }else if(
      loc=="/pages/User/prijava.html" ||
      loc=="/pages/User/registracija.html" ||
      loc=="/pages/User/Galerija_vijesti.html" ||
      loc=="/pages/User/o_autoru.html" ||
      loc=="/pages/User/Rang_lista.html" ||
      loc=="/pages/User/dokumentacija.html"
     ){
      links.push("Galerija_vijesti.html");
      links.push("o_autoru.html");
      links.push("dokumentacija.html");
      links.push("Rang_lista.html");
      links.push("prijava.html");
    }

    return links
}

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
     <li class="profile">
       <div class="profile-details">
       </div>
     </li>
    `
    return html;
}


function loadFooter(){
    var html;
    html = `
    <div class="footer">
      <address>
        <p> <a href="mailto:dbadel@foi.hr"> Dorian Badel</a> &copy; 2022.</p>
      </address>
      <div class="footer_icons">
        <!--<a href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2021/zadaca_02/dbadel/index.html" class="footer_icon-html">
          <img src="materijali/HTML5.png" alt="HTML validator">
        </a>
        <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2021/zadaca_02/dbadel/index.html" class="footer_icon-html">
          <img src="materijali/CSS3.png" alt="CSS validator">
        </a>-->
      </div>
    </div>
    `;
    return html;
}
