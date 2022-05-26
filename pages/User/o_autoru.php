<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>Dokumentacija</title>

  <link rel="stylesheet" href="../../index.css">
  <link rel="stylesheet" href="style/o_autoru.css">

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

    <div id="popup" class="popup">
      <?php
        if(!isset($_COOKIE['uvjeti'])){
          echo "
          <script>
            var pu = document.getElementById('popup');
            pu.style.display = 'inherit';
          </script>";

          require_once('../../globals/smarty/smarty_main.php');
          include '../../globals/global.php';

          $sql = "SELECT * FROM uvjeti_koristenja";
          $izvrsi = mysqli_query($connection, $sql);
          $opcije = array();
          $i = 0;
          while($row = $izvrsi->fetch_array()){
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
        }
       ?>

    </div>
    <div class="section_header">
      <h1>O autoru</h1>
    </div>

    <div class="section_body">
      <!-- Kao na iksici -->
      <div class="profile__image">
        <img src="../../media/me-jpeg.jpeg" alt="Dorian Badel">
      </div>

      <div>
        <div class="profile__name">
          <p>Dorian Badel</p>
        </div>


      <!--ime, prezime, broj iksice, mail  (mail otvara slanje maila)-->
        <div class="profile__info">
          <span><em>Dodatne informacije o meni:</em></span>
          <p><span>Broj iksice: </span>0016145520</p>
          <p><span>Email: <a href="mailto:dbadel@foi.hr"></span> dbadel@foi.hr</a> </p>
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
