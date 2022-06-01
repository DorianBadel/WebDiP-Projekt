function ucitajPodatke(){
  let vijest;
  let section = document.querySelector(".section__rec");
  section.innerHTML = "";
  console.log("test1");

  $.ajax({url: "https://barka.foi.hr/WebDiP/2021_projekti/WebDiP2021x003/tablice/blok_kor.xml",
    type: "GET",
    dataType: "xml",
    success: function(result){
      $(result).find("xml blokiran").each(function(){
          vijest = `
          <div class="recenzija">
                <h3>`+($(this).find('korisnik').text() || "Podatak ne postoji")+`</h3>
                <p>`+($(this).find('razlog').text() || "Podatak ne postoji")+`</p>
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

  if(document.title.match('Blokirani korisnici')){
    console.log("Spojen na blokirane korisnike");

    ucitajPodatke();
  }else{
    console.log("error");
  }
});
