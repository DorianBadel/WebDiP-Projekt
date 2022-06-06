<?php
  include '../../../globals/global.php';
  $dataB = new DB();

  if(!empty($_POST["korime"])){
    if($dataB->exists($_POST["korime"])){
      echo "<span style='color: red'>Korisnik vec postoji</span>";
    }else{
      echo "<span style='color: green'>Dobro korisnicko ime!</span>";
    }
  }
?>
