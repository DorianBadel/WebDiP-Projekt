<?php
  include '../../../globals/global.php';
  $dataB = new DB();

  if(!empty($_POST["korime"])){
    if($dataB->exists($_POST["korime"])){
      echo "<span style='color: red'>Korisnik vec postoji</span>";
    }else{
      if(strlen($_POST["korime"]) < 5 || !preg_match("/.*[A-Z].*[a-z]/",$_POST["korime"])){
          echo "<span style='color: orange'>Morate dodati bar jedno veliko slovo i imati više od 5 znakova</span>";
      }else{
        echo "<span style='color: green'>Dobro korisnicko ime!</span>";
      }
    }
  }
?>
