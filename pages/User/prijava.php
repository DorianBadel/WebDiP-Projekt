<?php
include '../../globals/global.php';

session_start();

if(isset($_POST['submit']) && !empty($_POST['korime']) && !empty($_POST['lozinka'])){

  $korime = $_POST['korime'];
  $lozinka = $_POST['lozinka'];
  $lozinka_kript = hash('sha256',$lozinka);

  $korisnik = "SELECT * FROM korisnik WHERE korisnicko_ime='$korime'";

  $izvrsi = mysqli_query($connection, $korisnik);
  if($izvrsi->num_rows > 0){
    $row_kor = mysqli_fetch_assoc($izvrsi);
    $id_reda = $row_kor['ID_lozinke'];

    $kor_pass = "SELECT * FROM lozinka WHERE ID='$id_reda'";
    $izvrsi = mysqli_query($connection, $kor_pass);
    if($izvrsi->num_rows > 0){
      $row_pass = mysqli_fetch_assoc($izvrsi);
      if($row_pass['lozinka_kript'] == $lozinka_kript){

        $datum = date('Y-m-d H:i:s');

        $db_ID_kor = $row_kor['ID'];
        $_SESSION['username'] = $row_kor['korisnicko_ime'];
        $_SESSION['start'] = $datum;

        $sql_sess = "INSERT INTO sesija (ID, pocetak_sesije, ID_konfiguracije)
        VALUES ('$korime','$datum', '1')";

        $db_res_session = mysqli_query($connection, $sql_sess);
        $db_sess_id = mysqli_insert_id($connection);

        $sql_upd_kor = "UPDATE korisnik SET ID_sesije='$db_sess_id' WHERE ID = '$db_ID_kor'";
        $db_res_kor_sess = mysqli_query($connection, $sql_upd_kor);

        if($db_res_kor_sess){
          echo "<script> alert('uspjeh'); </script>";
          header('Refresh:0; url=../../index.php');
        }

      } else {
        echo "
        <script>
          let msg = document.getElementById('section_msg');
          msg.innerHTML = 'Pogresan unos podataka [lozinka]';
        </script>";
      }
    }
  }else{
    echo "<script> alert('korisnik ne postoji!') </script>";
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
  <title>Prijava</title>

  <link rel="stylesheet" href="../../index.css">
  <link rel="stylesheet" href="style/prijava.css">

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
      <h1>Log-innn</h1>
    </div>

    <div class="section_body">

        <div class="section_body-inner">
          <div id="section_msg">
          </div>
            <form action"" method="POST">
                <label for="korime">Korisničko ime:</label>
                <input type="text" name="korime">
                <label for="lozinka">Lozinka:</label>
                <input type="password" name="lozinka">

                <button name="submit">Log-in</button>
                <p>Nisi prijavljen? <a href="registracija.php">Registriraj se</a></p>

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
