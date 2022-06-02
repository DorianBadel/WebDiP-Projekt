<?php
if(
  isset($_POST['submit'])
  && !empty($_POST['naslov'])
  && !empty($_POST['tekst'])
  && !empty($_POST['autori'])
  && !empty($_POST['izvor'])
  && !empty($_POST['slika_src'])
  && !empty($_POST['kategorija'])
){
  $kategorijaID = $_POST['kategorija'];
  $naslov = $_POST['naslov'];
  $tekst = $_POST['tekst'];
  $izvor = $_POST['izvor'];
  $autori = $_POST['autori'];
  $slika_src = $_POST['slika_src'];
  $video_src = $_POST['video_src'];
  $audio_src = $_POST['audio_src'];

  @session_start();

  $kor = $dataB->query("SELECT * FROM korisnik WHERE korisnicko_ime = ?","s",false,[$_SESSION['username']]);
  $id_kor = $kor[0]['ID'];


  $dataB = new DB();

  $datum = date('Y-m-d H:i:s');

  try{
    $dataB->query("INSERT INTO `vijest`
      (`tekst`, `naslov`, `autori`, `url_za_izvor`, `datum_objave`, `verzija_vj`, `slika_src`, `video_src`, `audio_src`, `ID_kategorije`,`ID_statusa`, `ID_autor`)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?)","sssssisssiii"
    ,true,
    [$tekst,$naslov,$autori,$izvor,$datum,'1',$slika_src,$video_src,$audio_src,$kategorijaID,'1',$id_kor]);
  } catch (Exception $ex){
    echo "<script>console.log("$ex->getMessage()") </script>";
  }
}
?>
