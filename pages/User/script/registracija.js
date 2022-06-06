$(document).ready(function(){
  if(document.title.match('Registracija')){
    var izmjena = false;

    $("input").keyup(function(){
      $("input").css("background-color", "pink");
    });

    function dobarUnos(){
      var jeIspravno = [];
      var ispravno = true;

      function provjeriKorIme(tekst){
        var provjera = new RegExp(/.*[A-Z].*[a-z]/);
        jeIspravno.push(provjera.test(tekst));
      }

      function provjeriImePrez(tekst){
        var provjera = new RegExp(/^[A-Z]/);
        jeIspravno.push(provjera.test(tekst));
      }

      function provjeriLozinku(tekst){
        var provjera = new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,30}$/);
        jeIspravno.push(provjera.test(tekst));
      }

      function provjeriMail(tekst){
        var provjera = new RegExp(/^\S+@\S+\.\S+$/);
        jeIspravno.push(provjera.test(tekst));
      }

      provjeriImePrez($("#java-ime").val());
      provjeriImePrez($("#java-prezime").val());
      provjeriMail($("#java-mail").val());
      provjeriKorIme($("#java-korime").val());
      provjeriLozinku($("#java-loz").val());

      for(var i =0; i<jeIspravno.length; i++){
        console.log(jeIspravno[i]);
        if(jeIspravno[i] == false) ispravno = false;
      }

      return ispravno;
    }
  }
})
