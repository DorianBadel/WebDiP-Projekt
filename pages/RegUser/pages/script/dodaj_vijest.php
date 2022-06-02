<?php
  if(isset($_POST['submit'])){
    include '../../../../globals/global.php';
    echo "test";

    $dataB = new DB();
    @session_start();

    $kategorijaID = $_POST['kategorija'];
    $naslov = $_POST['naslov'];
    $tekst = $_POST['tekst'];
    $izvor = $_POST['izvor'];
    $autori = $_POST['autori'];
    $slika_src = $_POST['slika_src'];
    $video_src = $_POST['video_src'];
    $audio_src = $_POST['audio_src'];

    $kor = $dataB->query("SELECT * FROM korisnik WHERE korisnicko_ime = ?","s",false,[$_SESSION['username']]);
    $id_kor = $kor[0]['ID'];
    echo "test";

    //$datum = date('Y-m-d H:i:s');

    $dataB->query("INSERT INTO `vijest`(`tekst`, `naslov`, `autori`, `url_za_izvor`, `verzija_vj`, `slika_src`, `video_src`, `audio_src`, `ID_kategorije`,`ID_statusa`, `ID_autor`)
    VALUES (?,?,?,?,?,?,?,?,?,?,?)","ssssisssiii",true,[$tekst,$naslov,$autori,$izvor,'1',$slika_src,$video_src,$audio_src,$kategorijaID,'1',$id_kor]);


  }


?>
