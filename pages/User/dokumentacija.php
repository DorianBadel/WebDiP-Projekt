<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>Dokumentacija</title>

  <link rel="stylesheet" href="../../index.css">
  <link rel="stylesheet" href="style/dokumentacija.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  <!--Globals-->
  <script src="../../globals/template.js" type="text/javascript"></script>
  <link rel="stylesheet" href="../../globals/template.css">

</head>
<body>

  <header id="header">
    <div class="sidebar">
    <div class="logo-details">
        <a href="../../index.php">
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
    <<div id="popup" class="popup">
      <?php
      if(empty($_SESSION['username'])){
        if(!isset($_COOKIE['uvjeti'])){
          echo "
          <script>
            var pu = document.getElementById('popup');
            pu.style.display = 'inherit';
          </script>";

          require_once('../../globals/smarty/smarty_main.php');
          include '../../globals/global.php';
          $dataB = new DB();

          $sql_uvjeti = $dataB->query("SELECT * FROM uvjeti_koristenja");

          $opcije = array();
          $i = 0;
          foreach($sql_uvjeti as &$row){
            $opcije[] = $row["opis_uvjeta"];
            $smarty->assign('opcije',$opcije);
            $i++;
          }
          $smarty->display("../../globals/smarty/components/index.tpl");
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
      <h1>Dokumentacija</h1>
    </div>

    <div class="section_body">
      <div class="documentation">
        <div class="docu__a-opis"> <!-- Opis projektnog zadatka -->
          <span>Opis projektnog zadatka: </span>
          <hr>
          <p>Ovo je opis</p>
        </div>
        <div class="docu__b-opis"> <!-- Opis projektnog rjesenja -->
          <span>Opis projektnog rješenja: </span>
          <hr>
          <p>Ovo je opis</p>
        </div>
        <div class="docu__c-ERA"> <!-- "Bitne odrednice projektnog rješenja" ERA -->
          <span>ERA dijagram:  </span>
          <hr>
          <p>Ovo je opis</p>
          <img src="" alt="ERA dijagram">
        </div>
        <div class="docu__d-skripte"> <!-- "popis i opis skripata, mapa mjesta, navigacijski dijagram" -->
          <span>Popis i opis skripata, mapa mjesta, navigacijski dijagram </span>
          <hr>
          <p>Ovo je opis</p>
          <img src="" alt="Navigacijski dijagram">
        </div>
        <div class="docu__e-tehnologije"> <!-- "popis i opis korištenih tehnologija i alata" -->
          <span>Popis i opis korištenih tehnologija i alata</span>
          <hr>
          <p>Ovo je opis</p>
          <img src="" alt="ERA dijagram">
        </div>
        <div class="docu__f-tehnologije"> <!-- "popis i opis vanjskih (tuđih) modula/biblioteka i njihovo korištenje u skriptama i sl." -->
          <span>Popis i opis vanjskih (tuđih) modula/biblioteka i njihovo korištenje u skriptama i sl.</span>
          <hr>
          <p>Ovo je opis</p>
        </div>
      </div>
    </div>

    <!-- If user has no JS -->
    <noscript>Sorry, your browser does not support JavaScript!</noscript>

  </section>
  <footer id="footer">


  </footer>




</body>
</html>
