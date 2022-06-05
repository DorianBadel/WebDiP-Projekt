<?php
  $requireLogin =true;
  $minStatus = 4;
  include "../../../globals/global.php"
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>Kategorije</title>

  <link rel="stylesheet" href="../../../index.css">
  <link rel="stylesheet" href="../../RegUser/style/moj_recenzije.css">
  <link rel="stylesheet" href="../../RegUser/style/addedit.css">


  <!--Globals-->
  <script src="../../../globals/template.js" type="text/javascript"></script>
  <link rel="stylesheet" href="../../../globals/template.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  <script src="script/get_xml.js" ></script>
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
              echo "<a href='../../globals/logout.php'><i class='bx bx-log-out' id='log_out'></i></a>";
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
      <h1>Kategorije</h1>
    </div>

    <div class="sub__header">
      <div class ="sub__header-buttons">
        <div class="add">
          <a onClick="triggerMenuAdd()">
            <i class='bx bxs-plus-square'></i>
          </a>
        </div>

        <div class="add_form" id="add_form" style="display: none">

          <form action"" method="POST">
              <label for="kategorija">Naziv kategorije:</label>
              <input type="text" name="kategorija" required>
              <label for="sazetak">Kratko o kategoriji:</label>
              <input type="text" name="sazetak" required>
              <label for="opis">Detaljan opis kategorije:</label>
              <textarea type="text" name="opis"></textarea>

              <button name='submit' onClick='triggerMenuAdd()'>Dodaj vijest</button>
          </form>
        </div>

        <div class="add_form" id="edit_form" style="display: none">

          <form action"" method="POST">
              <label for="kategorija">Naziv kategorije:</label>
              <input type="text" name="kategorija"  id="kat" required>
              <label for="sazetak">Kratko o kategoriji:</label>
              <input type="text" name="sazetak"  id="opi" required>
              <label for="opis">Detaljan opis kategorije:</label>
              <textarea type="text" name="opis" id="opis"></textarea>

              <input type="HIDDEN" name="ind"  id="id" required>

              <button name='edit' >Uredi kategoriju</button>
          </form>
        </div>

        <div class="add_form" id="add_mod" style="display: none">

          <form action"" method="POST">

            <label for="mod">Izaberite moderatora:</label>
              <select class="moderator" name="mod" required>
                <?php
                  include 'script/dodaj_kat.php';

                  $dataB = new DB();
                  $sql = $dataB->query("SELECT * FROM korisnik WHERE ID_tipa_korisnika = ?",'i',false,['3']);

                  foreach($sql as &$rec){
                    $html = "<option value='".$rec['ID']."'>".$rec['korisnicko_ime']."</option>";
                    echo $html;
                  }
                ?>
              </select>


          </form>
        </div>





        <script type="text/javascript">
          function triggerMenuAdd(){
            event.preventDefault();
            var pu = document.getElementById('add_form');
            if(pu.style.display === "none"){
              pu.style.display = "block";
            } else {
              pu.style.display = 'none';
            }
          }
          function triggerEditKat(kat){
            event.preventDefault();
            event.preventDefault();
            var pu = document.getElementById('edit_form');
            document.getElementById('kat').value = kat.getAttribute('kat-naziv');
            document.getElementById('opi').value  = kat.getAttribute('kat-opis-short');
            document.getElementById('opis').value = kat.getAttribute('kat-opis-long');
            document.getElementById('id').value = kat.getAttribute('kat-id');

            if(pu.style.display === "none"){
              pu.style.display = "block";
            } else {
              pu.style.display = 'none';
            }
          }
          function triggerAddMod(kat){
            event.preventDefault();
            var pu = document.getElementById('add_mod');
            if(pu.style.display === "none"){
              pu.style.display = "block";
            } else {
              pu.style.display = 'none';
            }
          }
        </script>

      </div>

    </div>
    <div class="section_body" id="bod">
      <div class="section__rec">


      </div>
    </div>

    <!-- If user has no JS -->
    <noscript>Sorry, your browser does not support JavaScript!</noscript>

  </section>
  <footer id="footer">


  </footer>
</body>
</html>
