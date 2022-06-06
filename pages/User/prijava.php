<?php
if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{

    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
    exit;
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
    <div class="section_header">
      <h1>Log-innn</h1>
    </div>

    <div class="section_body">

        <div class="section_body-inner">
          <div class="returnMessage">
            <?php
              if(isset($br_pokusaja)) echo $br_pokusaja;
              if(!empty($warning)){
                echo "<p style='color: red'>$warning</p>";
              }
              else if(isset($success)){
                echo "<p style='color: green'>Uspjesan login</p>";
              }
            ?>
          </div>
            <form action"" method="POST">
                <label for="korime">Korisničko ime:</label>
                <input type="text" name="korime">
                <label for="lozinka">Lozinka:</label>
                <input type="password" name="lozinka">

                <button name="submit">Log-in</button>
                <p>Nisi prijavljen? <a href="registracija.php">Registriraj se</a></p>

            </form>

            <?php
            require '../../globals/global.php';

            if(isset($_POST['submit']) && !empty($_POST['korime']) && !empty($_POST['lozinka'])){

              $korime = $_POST['korime'];
              $lozinka = $_POST['lozinka'];

              $dataB = new DB();

              try{
              if($dataB->exists($korime)){
                $br_pokusaja = 25;
                $ID_lozinke = 25;
                try{
                  $korisnikInfo = $dataB->query("SELECT ID_lozinke , br_neuspj_unosa FROM korisnik WHERE korisnicko_ime = ?","s",false,[$korime]);
                  $br_pokusaja = $korisnikInfo[0]['br_neuspj_unosa'];
                  $ID_lozinke = $korisnikInfo[0]["ID_lozinke"];
                }catch (Exception $ex){
                  $warning = $ex->getMessage()."<br>";
                }

                if($br_pokusaja <= 3){

                  try{
                    $salt = $dataB->query("SELECT sol FROM lozinka WHERE ID = ?","s",false,[$ID_lozinke])[0]["sol"];
                  }catch (Exception $ex){
                    $warning = $ex->getMessage()."<br>";
                  }

                  $lozinka_kript = hash("sha256", $lozinka . $salt);


                  $provjera = $dataB->query("SELECT ID, lozinka FROM lozinka WHERE ID = ? AND lozinka_kript = ?","is",FALSE,[$ID_lozinke,$lozinka_kript]);


                  if(!empty($provjera)){
                    @session_start();
                    $dataB->query("UPDATE korisnik SET br_neuspj_unosa = ? WHERE korisnicko_ime = ?","is",true,[0,$korime]);

                    $datum = date('Y-m-d H:i:s');

                    $_SESSION['username'] = $korime;
                    $_SESSION['start'] = $datum;

                    header("location: ../../index.php");
                  } else {
                    "<script> console.log('azuriram') </script>";
                    $dataB->query("UPDATE korisnik SET br_neuspj_unosa = ? WHERE korisnicko_ime = ?","is",true,[$br_pokusaja+1,$korime]);
                    header("Refresh:0");
                  }

                } else echo "<script> console.log('BLOKIRAN SI') </script>";

              }
              }//try
              catch(Exception $ex){
                $warning = $ex->getMessage();
              }
            }
            ?>
        </div>

    </div>

    <!-- If user has no JS -->
    <noscript>Sorry, your browser does not support JavaScript!</noscript>

  </section>
  <footer id="footer">


  </footer>




</body>
</html>
