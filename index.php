<!DOCTYPE html>
<!--Completely skipped:
  23. Privatni direktorij za ispis korisnickih podataka
  Upute: 20. 21. 22.
  19. Virtualno vrijeme
  <!- rjeseno 18. ->
  16. Zaštita XSS i SQL
  15. Prijava mora bit preko HTTPS
  13. Prijava dupla autentifikacija
  14. Lozinke: SHA256 (using salt) i citljivo

   Pitanja:
  1. opis moderatora:
  * Može tagirati vijesti sa jednom ili više ključnih riječi odvojeni znakom “;”
  Q: Radi li to preko recenzije vijesti i dali moze to napraviti samo vijestima za koje je zaduzen

  2.


 -->
 <?php
  require_once('globals/smarty/smarty_main.php');
 ?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>HOME</title>

  <link rel="stylesheet" href="index.css">

  <!--Globals-->
  <script src="./globals/template.js" type="text/javascript"></script>
  <!--Popup-->
  <link rel="stylesheet" href="./globals/template.css">


</head>
<body>
  <header id="header">
    <div class="sidebar">
    <div class="logo-details">
      <a href="index.php">
        <i class='bx bxs-news' id='btn'></i>
      </a>
    </div>
      <ul class="nav-list">



        <li class="profile">
          <div class="profile-details">
            <?php
              session_start();
              if(empty($_SESSION['username'])){
                echo "<a href='pages/User/prijava.php'><i class='bx bx-log-in' id='log_out'></i></a>";
              }
              else{
                echo "<a href='globals/logout.php'><i class='bx bx-log-out' id='log_out'></i></a>";
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

          include 'globals/global.php';

          $sql = "SELECT * FROM uvjeti_koristenja";
          $izvrsi = mysqli_query($connection, $sql);
          $opcije = array();
          $i = 0;
          while($row = $izvrsi->fetch_array()){
            $opcije[] = $row["opis_uvjeta"];
            $smarty->assign('opcije',$opcije);
            $i++;
          }
          $smarty->display("globals/smarty/components/index.tpl");
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
        <h1>Home</h1>
      </div>
      <div class="section_welcome">
        <p>Dobrodošao/la! <span id="welcome_username">
          <?php
            if(empty($_SESSION['username'])){
              echo "Neregistrirani korisnik";

            }
            else{
              echo $_SESSION['username'];
            }
           ?>
        </span> na tvoju novu jedinu postaju za sve <em>vijesti!</em></p>

      </div>

      <!-- If user has no JS -->
      <noscript>Sorry, your browser does not support JavaScript!</noscript>

  </section>
  <footer id="footer">

  </footer>
</body>
</html>
