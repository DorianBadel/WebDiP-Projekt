<style>
  .conditions div{
    display:block;
    text-align:left;
    padding: 10px;
  }
</style>

  <div class="conditions">
    <span> Uvjeti korištenja </span>
    <p> Mi pohranjujemo samo neosjetljive informacije o vašem korištenju aplikacije u svrhe statističke analize i poboljšanje korisničkog iskustva </p>
    <div>
      <input type="radio" name="uvjet" value="1" class="cb" onClick="showBtn()">
      <label for="uvjeti1">{$opcije[0]}</label>
    </div>
    <div>
      <input type="radio" name="uvjet" value="2" class="cb" onClick="showBtn()">
      <label for="uvjeti2">{$opcije[1]}</label>
    </div>
    <div>
      <input type="radio" name="uvjet" value="3" class="cb" onClick="showBtn()">
      <label for="uvjeti3">{$opcije[2]}</label>
    </div>


    <div id="acceptBtn">


    </div>

    <script>
      function showBtn(){
        var cboxes = document.querySelectorAll(".cb");
        var btn = document.getElementById("acceptBtn");
        var anyChecked = false;

        cboxes.forEach(function(cb){
          if(cb.checked) anyChecked = true;
        });

        if(anyChecked){
          btn.innerHTML = '<button onClick="setCookies()">Accept terms</button>';
        } else{
          btn.innerHTML = '';
        }

      }

      function setCookie(korisnik, odabrano, istice){
        let rok = new Date();
        rok.setTime(rok.getTime() + (istice*86400*1000));
        document.cookie =  korisnik + "=" + (odabrano || "") + "; expires="+ rok.toUTCString() +"; path=/";
        location.reload();
      }

      function setCookies(){
        var cboxA = document.querySelector("input[value='1']");
        var cboxB = document.querySelector("input[value='2']");
        var cboxC = document.querySelector("input[value='3']");

        if(cboxA.checked){
          setCookie("uvjeti","{$opcije[0]}");
        }
        if(cboxB.checked){
          setCookie("uvjeti","{$opcije[1]}");
        }
        if(cboxC.checked){
          setCookie("uvjeti","{$opcije[2]}");
        }
      }
    </script>





  </div>
