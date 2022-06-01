function ucitajPodatke(){

  var table = $('#java_table').DataTable(
    {
      "aaSorting": [[0,"desc"]],
      "bPaginate":true,
      "bDeferRender": true
    }
  );

  $.ajax({url: "https://barka.foi.hr/WebDiP/2021_projekti/WebDiP2021x003/tablice/auth_stat.xml",
    type: "GET",
    dataType: "xml",
    success: function(result){
      $(result).find("xml vijest").each(function(){
          table.row.add([
          ($(this).find('pregledi').text() || "Podatak ne postoji"),
          ($(this).find('naslov').text() || "Podatak ne postoji"),
          ($(this).find('autori').text() || "Podatak ne postoji"),
          ($(this).find('datum').text() || "Podatak ne postoji")
          ]).draw(false);

      })
    }
  });

}

function ucitajPodatkeVijest(){
  let vijest;
  let section = document.querySelector(".section__news");
  section.innerHTML = "";

  $.ajax({url: "https://barka.foi.hr/WebDiP/2021_projekti/WebDiP2021x003/tablice/auth_stat.xml",
    type: "GET",
    dataType: "xml",
    success: function(result){
      $(result).find("xml vijest").each(function(){
          vijest = `
          <div class="news">

              <figure>
                <a href=""> <i class='bx bx-edit'></i> </a>
                <img src=`+$(this).find('slika').text()+` alt="Podatak ne postoji"
              </figure>
              <a href="">
                <h3>`+($(this).find('naslov').text() || "Podatak ne postoji")+`</h3>
                <p>`+($(this).find('tekst').text() || "Podatak ne postoji")+`</p>
                <span>`+($(this).find('autori').text() || "Podatak ne postoji")+`</span>
                <p class="broj_pregleda">`+($(this).find('pregledi').text() || "Podatak ne postoji")+`</p>
              </a>
          </div>
          `;

          section.innerHTML += vijest;
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

    ucitajPodatkeRecenzije();
  }else{
    console.log("error");
  }
});
