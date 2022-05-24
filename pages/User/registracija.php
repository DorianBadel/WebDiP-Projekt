<?php
include '../../globals/global.php';

if(isset($_POST['submit']) && !empty($_POST['ime']) && !empty($_POST['prezime'])
&& !empty($_POST['korime']) && !empty($_POST['uvjeti']) && !empty($_POST['lozinka'])){
  $ime = $_POST['ime'];
  $prezime = $_POST['prezime'];
  $opis = $_POST['opis'];
  $korime = $_POST['korime'];
  $lozinka = $_POST['lozinka'];
  $ponlozinka = $_POST['ponlozinka'];
  $uvjeti = $_POST['uvjeti'];

  if($lozinka == $ponlozinka){

    $lozinka_kript = hash('sha256',$ponlozinka);

    $sql_pass = "INSERT INTO lozinka (lozinka, lozinka_kript)
    VALUES ('$lozinka','$lozinka_kript')";

    $result = mysqli_query($connection, $sql_pass);

    if($result){
      $ID_lozinke = mysqli_insert_id($connection);

      $sql_user = "INSERT INTO korisnik (ime, prezime, opis, korisnicko_ime, ID_lozinke, ID_uvjeta, ID_tipa_korisnika)
      VALUES ('$ime','$prezime','$opis','$korime','$ID_lozinke', '$uvjeti','2')" ;

      $result = mysqli_query($connection, $sql_user);
      if($result){
        header('Refresh:3; url=prijava.php');
        redirect();

      }else{
        echo "<script> alert('Registracija neuspješna !')</script>";
      }

    }
  }else{
    echo "<script> alert('Lozinke nisu iste!')</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>Registracija</title>

  <link rel="stylesheet" href="../../index.css">
  <link rel="stylesheet" href="style/prijava.css">
  <link rel="icon" href="../../media/logo.png">

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
    <div class="section_header">
      <h1>Registracija</h1>
    </div>

    <div class="section_body">
        <div class="section_body-inner">
            <div class="returnMessage"></div>
            <form action"" method="POST">
                <label for="ime">Ime:</label>
                <input type="text" name="ime" placeholder="Ime...">
                <label for="prezime">Prezime:</label>
                <input type="text" name="prezime" placeholder="Prezime...">
                <label for="opis">Opis:</label>
                <textarea name="opis" cols="30" rows="10" placeholder="Opis..."></textarea>
                <label for="korime">Korisničko ime:</label>
                <input type="text" name="korime" placeholder="Korisničko ime...">
                <label for="lozinka">Lozinka:</label>
                <input type="password" name="lozinka" placeholder="Lozinka...">
                <label for="ponlozinka">Ponovljena lozinka:</label>
                <input type="password" name="ponlozinka" placeholder="Ponovljena lozinka...">
                <label for="uvjeti">Uvjeti koristenja:</label>
                <input type="number" name="uvjeti" placeholder="1/2">

                <button type="submit" name="submit">Registriraj se</button>
                <p>Već imaš profil? <a href="prijava.php">Prijavi se</a></p>

            </form>
        </div>

    </div>

    <!-- If user has no JS -->
    <noscript>Sorry, your browser does not support JavaScript!</noscript>

  </section>
  <footer id="footer">


  </footer>




</body>
</html>
