<?php
  if(isset($_POST['add'])){

    $dataB = new DB();
    @session_start();

    $datum = date('Y-m-d H:i:s');

    $kor = $dataB->query("SELECT * FROM korisnik WHERE korisnicko_ime = ?","s",false,[$_SESSION['username']]);
    $kor_id = $kor[0]['ID'];

    //$datum = date('Y-m-d H:i:s');

    $dataB->query("INSERT INTO `vijest`(
      `tekst`,
      `naslov`,
      `autori`,
      `url_za_izvor`,
      `datum_objave`,
      `verzija_vj`,
      `slika_src`,
      `video_src`,
      `audio_src`,
      `ID_statusa`,
      `ID_kategorije`,
      `ID_autor`)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?)","sssssisssiii",
    true,[$_POST['tekst'],$_POST['naslov'],$_POST['autori'],$_POST['izvor'],$datum,'1',$_POST['slika_src'],$_POST['video_src'],$_POST['audio_src'],'1',$_POST['kategorija'],$kor_id]);


  }


?>
