<?php
  if(isset($_POST['add'])){

    $kor_id = $dataB->query("SELECT * FROM korisnik WHERE korisnicko_ime = ?","s",false,[$_POST['kor']]);
    $kor_id = $kor_id[0]['ID'];
    $kat_id = $dataB->query("SELECT * FROM kategorija  WHERE naziv = ?","s",false,[$_POST['kat']]);
    $kat_id = $kat_id[0]['ID'];

    $sql = $dataB->query("INSERT INTO `blokiran`(`ID_korisnika`, `ID_kategorije`, `razlog_blokiranja`, `blokiran_od`, `blokiran_do`)
      VALUES (?,?,?,?,?)","iisss",true,[$kor_id,$kat_id,$_POST['raz'],$_POST['od'],$_POST['doD']]);

  }
?>
