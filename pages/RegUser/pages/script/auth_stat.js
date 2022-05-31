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

$(document).ready(function(){
  console.log(document.title);

  if(document.title.match('Statistika autora')){
    console.log("Spojen na statistiku autora");
    
    ucitajPodatke();
  }else{
    console.log("error");
  }
});
