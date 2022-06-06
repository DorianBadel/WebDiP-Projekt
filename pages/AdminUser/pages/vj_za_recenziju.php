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
  <title>Vijesti za recenziju</title>

  <link rel="stylesheet" href="../../../index.css">
  <link rel="stylesheet" href="../../RegUser/style/moj_recenzije.css">


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
      <h1>Vijesti za recenziju</h1>
    </div>
    </div>



    <div class="section_body" id="bod">
      <div class="section__rec">


      </div>
    </div>

    <div class="add_form" id="add_mod" style="display: none">
      <form action"" method="POST">
        <input type="text" name="indkat"  id="indkat" required>
        <input type="text" name="indvj"  id="indvj" required>

        <div id="select-rec">
        </div>

        <label for="mod">Izaberite recenzenta:</label>
          <select class="moderator" name="rec" required>
            <?php
              if(isset($_POST['dodaj'])){

                $dataB = new DB();
                $sql = $dataB->query("SELECT `korisnik`.`korisnicko_ime`, `kategorija`.`ID`, `pripada`.`ID_kategorije`
                  FROM `korisnik`
                      LEFT JOIN `pripada` ON `pripada`.`ID_korisnika` = `korisnik`.`ID`
                      LEFT JOIN `kategorija` ON `pripada`.`ID_kategorije` = `kategorija`.`ID`
                  WHERE `kategorija`.`ID` = ? AND `pripada`.`jeModerator` = '1'",'i',false,[$_POST['indkat']]);

                foreach($sql as &$rec){
                  $html = "<option value='".$rec['ID']."'>".$rec['korisnicko_ime']."</option>";
                  echo $html;
                }
              }
            ?>
          </select>

          <button name='modAdd' >Dodaj moderatora</button>


      </form>
    </div>

    <SCRIPT>
      function triggerAddMod(kat){
        event.preventDefault();
        var pu = document.getElementById('add_mod');
        document.getElementById('indkat').value = kat.getAttribute('kat-id');
        document.getElementById('indvj').value = kat.getAttribute('vj-id');
        document.getElementById('select-rec');
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
