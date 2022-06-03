<?php
  if(isset($_POST['submit'])){
    $dataB = new DB();

    $datum = date('Y-m-d H:i:s');

    $sql = $dataB->query("UPDATE vijest SET
      `tekst` = ?,
      `naslov` = ?,
      `autori` = ?,
      `url_za_izvor` = ?,
      `datum_objave` = ?,
      `verzija_vj` = ?,
      `slika_src` = ?,
      `video_src` = ?,
      `audio_src` = ?,
      `ID_statusa` = ?
    WHERE `vijest`.`ID` = ?;","sssssisssii",true,[$_POST['tekst'],$_POST['naslov'],$_POST['autori'],$_POST['izvor'],$datum,$_POST['verzija']+1,$_POST['slika_src'],$_POST['video_src'],$_POST['audio_src'],'1',$_POST['index']]);

  }


?>
