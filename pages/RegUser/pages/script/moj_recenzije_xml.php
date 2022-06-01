<?php
  include '../../../../globals/global.php';
  $dataB = new DB();
  @session_start();

  $korisnik = $dataB->query("SELECT * FROM korisnik WHERE korisnicko_ime = ?","s",false,[$_SESSION['username']]);

  if($korisnik){
    $sql = $dataB->query(" SELECT `recenzija`.`komentar`, `tip_statusa`.*, `vijest`.`naslov`
    FROM `vijest`
    LEFT JOIN `recenzija` ON `recenzija`.`ID_vijesti` = `vijest`.`ID`
    LEFT JOIN `tip_statusa` ON `vijest`.`ID_statusa` = `tip_statusa`.`ID`
    WHERE ID_autor = ?
    ","i",false,[$korisnik[0]['ID']]);

    $xmlDom = new DOMDocument('1.0','UTF-8');

    $xmlRoot = $xmlDom->createElement("xml");
    $xmlRoot = $xmlDom->appendChild($xmlRoot);
    $file = "../../../../tablice/recenzije_auth.xml";

    if($file) unlink($file);

    foreach($sql as &$r){
      $t1 = $r['naslov'];
      $t2 = $r['naziv_statusa'];
      $t3 = $r['komentar'];


      $element = $xmlDom->createElement("recenzija");
      $element = $xmlRoot->appendChild($element);
      $element->appendChild($xmlDom->createElement('naslov',$t1));
      $element->appendChild($xmlDom->createElement('naziv_statusa',$t2));
      $element->appendChild($xmlDom->createElement('komentar',$t3));

    }

    echo $xmlDom->save("../../../../tablice/recenzije_auth.xml");
  } else { echo "problem z bazom (korisnik)";};

 ?>
