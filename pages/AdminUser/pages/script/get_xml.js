function ucitajPodatke(){
  let vijest;
  let section = document.querySelector(".section__rec");
  section.innerHTML = "";

  $.ajax({url: "https://barka.foi.hr/WebDiP/2021_projekti/WebDiP2021x003/tablice/kategorije.xml",
    type: "GET",
    dataType: "xml",
    success: function(result){
      $(result).find("xml korisnik").each(function(){
          vijest = `
          <div class="recenzija">
                <h3>`+($(this).find('naziv').text() || "Podatak ne postoji")+`</h3>
                <span>`+($(this).find('sazetak').text() || "Podatak ne postoji")+`</span>
                <p>`+($(this).find('opis').text() || "Podatak ne postoji")+`</p>
            <a href=""><i class='bx bx-edit'></i></a>
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
  }else{
    console.log("error");
  }
});
