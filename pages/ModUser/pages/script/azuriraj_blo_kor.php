<?php
  if(isset($_POST['edit'])){

    $kor_id = $dataB->query("SELECT * FROM korisnik WHERE korisnicko_ime = ?","s",false,[$_POST['kor']]);
    $kor_id = $kor_id[0]['ID'];
    $kat_id = $dataB->query("SELECT * FROM kategorija  WHERE naziv = ?","s",false,[$_POST['kat']]);
    $kat_id = $kat_id[0]['ID'];

    $sql = $dataB->query("UPDATE `blokiran` SET
      `razlog_blokiranja`=?,
      `blokiran_od`=?,
      `blokiran_do`=?
      WHERE `ID_korisnika`=? AND `ID_kategorije`=?","sssii",true,[$_POST['raz'],$_POST['od'],$_POST['doD'],$kor_id,$kat_id]);

  }
?>