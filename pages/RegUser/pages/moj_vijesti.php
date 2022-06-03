<?php
  $requireLogin =true;
  $minStatus = 2;
  include "../../../globals/global.php"
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>Moje objave</title>

  <link rel="stylesheet" href="../../../index.css">
  <link rel="stylesheet" href="../../User/style/galerija.css">
  <link rel="stylesheet" href="../style/addedit.css">


  <!--Globals-->
  <script src="../../../globals/template.js" type="text/javascript"></script>
  <link rel="stylesheet" href="../../../globals/template.css">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="script/auth_stat.js" ></script>
</head>
<body>

<header id="header">
  <div class="sidebar">
  <div class="logo-details">
      <a href="../../../index.php">
           <i class='bx bxs-news' id='btn'></i>
      </a>
  </div>
  <ul class="nav-list">
    <li class="profile">
      <div class="profile-details">
        <?php
          session_start();
          if(empty($_SESSION['username'])){
            echo "<a href='prijava.php'><i class='bx bx-log-in' id='log_out'></i></a>";
          }
          else{
            echo "<a href='../../../globals/logout.php'><i class='bx bx-log-out' id='log_out'></i></a>";
          }
        ?>

      </div>
    </li>

   </ul>
 </div>


</header>
  <section class='body' id="body">

    <div id="popup" class="popup">
      <?php
      if(empty($_SESSION['username'])){
        if(!isset($_COOKIE['uvjeti'])){
          echo "
          <script>
            var pu = document.getElementById('popup');
            pu.style.display = 'inherit';
          </script>";

          require_once('../../../globals/smarty/smarty_main.php');
          include '../../../globals/global.php';
          $dataB = new DB();

          $sql_uvjeti = $dataB->query("SELECT * FROM uvjeti_koristenja");

          $opcije = array();
          $i = 0;
          foreach($sql_uvjeti as &$row){
            $opcije[] = $row["opis_uvjeta"];
            $smarty->assign('opcije',$opcije);
            $i++;
          }
          $smarty->display("../../../globals/smarty/components/index.tpl");
      } else{
          echo "
          <script>
            var pu = document.getElementById('popup');
            pu.style.display = 'none';
          </script>";
        }
      }else{
        echo "
        <script>
          var pu = document.getElementById('popup');
          pu.style.display = 'none';
        </script>";
      }
    ?>

    </div>

    <div class="section_header">
      <h1>Moje objave</h1>
    </div>
    </div>

    <div class="sub__header">
      <div class ="sub__header-buttons">
        <div class="add">
          <a onClick="triggerMenuAdd()">
            <i class='bx bxs-plus-square'></i>
          </a>
        </div>
      </div>

      <?php
      include "script/azuriraj_vijest.php";
      include "script/dodaj_vijest.php";
      $add = 3;
      ?>
      <div class="add_form" id="add_form" style="display: none">

        <form action"" method="POST">
            <label for="naslov">Naslov članka:*</label>
            <input type="text" name="naslov" id="naslov" required/>

            <label for="tekst">Tekst članka:*</label>
            <textarea type="text" name="tekst"  id="tekst" required></textarea>

            <label for="izvor">Link izvora:</label>
            <input type="text" name="izvor" id="izvor"/>

            <label for="autori">Popis autora:*</label>
            <input type="text" name="autori"  id="autori" required/>

            <label for="slika_src">Link slike:*</label>
            <input type="text" name="slika_src"  id="slika_src" required/>

            <label for="video_src">Link videa:</label>
            <input type="text" name="video_src" id="video_src"/>

            <label for="audio_src">Link zvucnog zapisa:</label>
            <input type="text" name="audio_src" id="audio_src"/>

            <label for="index" style="display: none">Ja san index</label>
            <input name ="index" type="text" id="index" style="display: none"/>
            <label for="verzija:" style="display: none"></label>
            <input id="verzija" type="text" name="verzija" style="display: none"/>



            <select name="kategorija" id="kategorija" required>
              <?php

                $dataB = new DB();
                @session_start();
                if($dataB->exists($_SESSION['username'])){
                  //pronadi ID_korisnika
                  $id_kor = $dataB->query("SELECT * FROM korisnik WHERE korisnicko_ime = ?","s",false,[$_SESSION['username']]);

                  $sql = $dataB->query("SELECT * FROM pripada WHERE ID_korisnika = ?",'i',false,[$id_kor[0]['ID']]);

                  foreach($sql as &$rec){
                    $kategorija = $dataB->query("SELECT * FROM kategorija WHERE ID = ?",'i',false,[$rec['ID_kategorije']]);
                    $ID_kat = $kategorija[0]['ID'];
                    $naziv_kat = $kategorija[0]['naziv'];

                    $html = "<option value='".$ID_kat."'>".$naziv_kat."</option>";
                    echo $html;
                  }
                } else {
                  $html = "<option value='0'>error</option>";
                  echo $html;
                }
              ?>
            </select>

            <div id="btnn">
            </div>

        </form>
      </div>
    </div>

    <div class="section_body" id="bod">
      <div class="section__news">
      </div>
    </div>
    <script type="text/javascript">
      function triggerMenu(el){
        event.preventDefault();
        let value = document.getElementById('btnn');
        value.innerHTML += "<button name='submit'>Azuriraj vijest</button>";
        document.getElementById('naslov').value = el.getAttribute('vj-name');
        document.getElementById('izvor').value = el.getAttribute('vj-izvor');
        document.getElementById('tekst').value = el.getAttribute('vj-tekst');
        document.getElementById('autori').value = el.getAttribute('vj-autori');
        document.getElementById('slika_src').value = el.getAttribute('vj-slika');
        document.getElementById('video_src').value = el.getAttribute('vj-video');
        document.getElementById('audio_src').value = el.getAttribute('vj-audio');
        document.getElementById('index').value = el.getAttribute('vj-index');
        document.getElementById('verzija').value = el.getAttribute('vj-verzija');
        document.getElementById('kategorija').value = el.getAttribute('vj-kateg');

        var pu = document.getElementById('add_form');
        if(pu.style.display === "none"){
          pu.style.display = "block";
        } else {
          pu.style.display = 'none';
        }
      }

      function triggerMenuAdd(){
        event.preventDefault();
        let v = document.getElementById('btnn');
        v.innerHTML = `<button name='add'>Dodaj vijest</button>`

        var pu = document.getElementById('add_form');
        if(pu.style.display === "none"){
          pu.style.display = "block";
        } else {
          pu.style.display = 'none';
        }
      }

    </script>
    <!-- If user has no JS -->
    <noscript>Sorry, your browser does not support JavaScript!</noscript>
  </section>
  <footer id="footer">
  </footer>
</body>
</html>
