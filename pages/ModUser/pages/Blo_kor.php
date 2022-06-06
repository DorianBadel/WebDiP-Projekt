<?php
  $requireLogin =true;
  $minStatus = 3;
  include "../../../globals/global.php"
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>Blokirani korisnici</title>

  <link rel="stylesheet" href="../../../index.css">
  <link rel="stylesheet" href="../../RegUser/style/moj_recenzije.css">


  <!--Globals-->
  <script src="../../../globals/template.js" type="text/javascript"></script>
  <link rel="stylesheet" href="../../../globals/template.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  <script src="script/read_xml.js" ></script>
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
        }}else{
          echo "
          <script>
            var pu = document.getElementById('popup');
            pu.style.display = 'none';
          </script>";
        }
       ?>
    </div>

    <div class="section_header">
      <h1>Blokirani korisnici</h1>
    </div>
    </div>
    <div class="section_body" id="bod">
      <?php
      include "script/azuriraj_blo_kor.php";
      ?>
      <div class="add_form" id="add_form_blok" style="display: none">

        <form action"" method="POST">
            <label for="naslov">Korisnik:*</label>
            <input type="text" name="kor" id="kor" required readonly/>

            <label for="tekst">Blokiran u kategoriji:*</label>
            <input type="text" name="kat"  id="kat" required readonly></input>

            <label for="izvor">Razlog blokiranja:*</label>
            <input type="text" name="raz" id="raz" required/>

            <label for="autori">Blokiran od:*</label>
            <input type="date" name="od"  id="od" required/>

            <label for="autori">Blokiran do:*</label>
            <input type="date" name="doD"  id="doD" required/>

            <div id="btnn">
              <button name='edit'>Azuriraj blokiranje</button>
              <button name='unblock'>Ukloni blokadu</button>
            </div>

        </form>
      </div>
      <div class="section__rec">


      </div>
    </div>

    <script type="text/javascript">
      function triggerEdit(blok){
        event.preventDefault();
        let value = document.getElementById('btnn');
        document.getElementById('kor').value = blok.getAttribute('blo-kor');
        document.getElementById('raz').value = blok.getAttribute('blo-raz');
        document.getElementById('od').value = blok.getAttribute('blo-od');
        document.getElementById('doD').value = blok.getAttribute('blo-do');
        document.getElementById('kat').value = blok.getAttribute('blo-kat');

        var pu = document.getElementById('add_form_blok');
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
