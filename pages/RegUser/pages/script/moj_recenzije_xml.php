<?php
  include '../../../../globals/global.php';
  $dataB = new DB();
  @session_start();
  header("Content-Type: text/xml");

  $korisnik = $dataB->query("SELECT * FROM korisnik WHERE korisnicko_ime = ?","s",false,[$_SESSION['username']]);

  if($korisnik){
    $sql = $dataB->query("SELECT `recenzija`.`komentar`, `tip_statusa`.*, `vijest`.`naslov`, `vijest`.`ID` as `VJid`
    FROM `vijest`
    LEFT JOIN `recenzija` ON `recenzija`.`ID_vijesti` = `vijest`.`ID`
    LEFT JOIN `tip_statusa` ON `vijest`.`ID_statusa` = `tip_statusa`.`ID`
    WHERE ID_autor = ?
    ","i",false,[$korisnik[0]['ID']]);

    $xmlDom = new DOMDocument('1.0','UTF-8');

    $xmlRoot = $xmlDom->createElement("xml");
    $xmlRoot = $xmlDom->appendChild($xmlRoot);


    foreach($sql as &$r){
      $t1 = $r['naslov'];
      $t2 = $r['naziv_statusa'];
      $t3 = $r['komentar'];
      $t4 = $r['VJid'];


      $element = $xmlDom->createElement("recenzija");
      $element = $xmlRoot->appendChild($element);
      $element->appendChild($xmlDom->createElement('naslov',$t1));
      $element->appendChild($xmlDom->createElement('naziv_statusa',$t2));
      $element->appendChild($xmlDom->createElement('komentar',$t3));
      $element->appendChild($xmlDom->createElement('ID',$t4));

    }

    echo $xmlDom->saveXML();
  } else { echo "problem z bazom (korisnik)";};

 ?>
