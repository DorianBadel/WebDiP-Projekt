<?php
require '../../globals/global.php';

if(isset($_POST['submit']) && !empty($_POST['ime']) && !empty($_POST['prezime'])
&& !empty($_POST['korime']) && !empty($_POST['uvjeti']) && !empty($_POST['lozinka']) && !empty($_POST['email'])){

  $warning = "";

  $ime = $_POST['ime'];

  $prezime = $_POST['prezime'];

  $opis = $_POST['opis'];
  $korime = $_POST['korime'];
  if(strlen($korime) < 5 || !preg_match("/.*[A-Z].*[a-z]/")) $warning .= "Korisnicko ime pre kratko";

  $lozinka = $_POST['lozinka'];
  if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,30}$/", $lozinka)) $warning .= "Lozinka mora imati minimalno jedno veliko slovo,malo slovo,broj, nekakav znak, min 8 znakova max 30";

  $ponlozinka = $_POST['ponlozinka'];
  if($lozinka != $ponlozinka) $warning .= "Lozinke nisu iste";

  $uvjeti = $_POST['uvjeti'];
  $email = $_POST['email'];
  if(!preg_match("/^\w+@\w+\.\w{2,4}$/", $email)) $warning .= "Mail je pogresan";


  try{
  if($warning == ""){
    $dataB = new DB();

    $aktivacijski_kod = hash("sha256", random_bytes(64));
    $salt = random_bytes(13);
    $salt = hash("sha256",$salt);


    $lozinka_kript = $lozinka . $salt;
    $lozinka_kript = hash("sha256", $lozinka_kript);

    if($dataB->exists($korime)){
      $warning .= "Korisnicko ime se vec koristi";
    } else{
      echo "<script> console.log('err1'); </script>";
      $rez = $dataB->query("INSERT INTO lozinka(lozinka, lozinka_kript, sol)
      VALUES (?,?,?)" , "sss", true, [$lozinka, $lozinka_kript, $salt]);

      $tip = 2;
      $ID_lozinke = $dataB->fetchId();
      echo "<script> console.log('err'); </script>";
      $rez = $dataB->query("INSERT INTO korisnik (ime, prezime, opis, korisnicko_ime, ID_lozinke, ID_uvjeta, ID_tipa_korisnika, email, aktivacijski_kod)
      VALUES (?,?,?,?,?,?,?,?,?)","ssssiiiss",true,[$ime,$prezime,$opis,$korime,$ID_lozinke,$uvjeti,$tip,$email,$aktivacijski_kod]);

      if($dataB->exists($korime)){
        $warning .= "Uspjesna registracija!";
        header("location: ./prijava.php");
        $success = true;
      }
    }
  }//no warnings
}//try
catch(Exception $ex){
  $warning .= $ex->getMessage();
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
  <script src="script/registracija.js" type="text/javascript"></script>
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
            <div class="returnMessage">
              <?php
                if(!empty($warning)){
                  echo "<p style='color: red'>$warning</p>";
                }
                else if(isset($success)){
                  echo "<p style='color: green'>$success</p>";
                }
              ?>
            </div>
            <form action"" method="POST">
                <span id="er-ime"></span>
                <label for="ime">Ime:</label>
                <input type="text" name="ime" id="java-ime" placeholder="Ime..." value="<?php echo @htmlspecialchars($ime) ?>" required>
                <label for="prezime">Prezime:</label>
                <input type="text" name="prezime" id="java-prezime" placeholder="Prezime..." value="<?php echo @htmlspecialchars($prezime) ?>" required>
                <label for="opis">Opis:</label>
                <textarea name="opis" cols="30" rows="10" placeholder="Opis..." value="<?php echo @htmlspecialchars($opis) ?>"></textarea>
                <label for="korime">Korisničko ime:</label>
                <input type="text" name="korime" id="java-korime" placeholder="Korisničko ime..." value="<?php echo @htmlspecialchars($korime) ?>" required>
                <label for="email">E-pošta:</label>
                <input type="email" name="email" id="java-mail" placeholder="Email..." value="<?php echo @htmlspecialchars($email) ?>" required>
                <label for="lozinka">Lozinka:</label>
                <input type="password" name="lozinka" id="java-loz" placeholder="Lozinka..."  required>
                <label for="ponlozinka">Ponovljena lozinka:</label>
                <input type="password" name="ponlozinka" id="java-pon-loz" placeholder="Ponovljena lozinka..."  required>
                <select name="uvjeti" value="<?php echo @htmlspecialchars($uvjeti) ?>" required>
                  <option value="1">Prihvacam dijeliti sve neosjetljive podatke s vama za optimalno iskustvo.</option>
                  <option value="2">Prihvacam dijeliti samo informacije za svrhu statistike</option>
                  <option value="3">Prihvacam dijeliti samo neophodne informacije.</option>
                </select>

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
