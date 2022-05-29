

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>HOME</title>

  <link rel="stylesheet" href="korisnici.css">

  <!--Globals-->
  <script src="./globals/template.js" type="text/javascript"></script>
  <link rel="stylesheet" href="./globals/template.css">
</head>
<body>
  <?php
    include '../globals/global.php';
    $dataB = new DB();

    $sql = $dataB->query("SELECT `korisnik`.`korisnicko_ime` AS `Korisnik`, `tip_korisnika`.`naziv_tipa` AS `Uloga`, `lozinka`.`lozinka` AS `Lozinka`
      FROM `lozinka`
      LEFT JOIN `korisnik` ON `korisnik`.`ID_lozinke` = `lozinka`.`ID`
      LEFT JOIN `tip_korisnika` ON `korisnik`.`ID_tipa_korisnika` = `tip_korisnika`.`ID`
  ");

    if($sql != null){
      echo '<table style="width:100%">
      <tr>
        <th> Korisnik </th>
        <th> Uloga </th>
        <th> Lozinka </th>
      </tr>

      ';
      foreach($sql as &$row){
        if($row["Korisnik"] != NULL){
          echo '
          <tr>
            <td>'. $row["Korisnik"] .'</td>
            <td>'. $row["Uloga"] .'</td>
            <td>'. $row["Lozinka"] .'</td>
          </tr>

          ';

        }
      }
      echo "</table>";
    }
   ?>

</body>
</html>
