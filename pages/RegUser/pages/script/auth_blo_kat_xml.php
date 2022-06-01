<?php
  include '../../../../globals/global.php';
  $dataB = new DB();
  @session_start();

  $korisnik = $dataB->query("SELECT * FROM korisnik WHERE korisnicko_ime = ?","s",false,[$_SESSION['username']]);

  if($korisnik){
    $sql = $dataB->query("SELECT `kategorija`.`naziv`, `blokiran`.`blokiran_do`
      FROM `kategorija`
      LEFT JOIN `blokiran` ON `blokiran`.`ID_kategorije` = `kategorija`.`ID`
      WHERE ID_korisnika =?",
      "i",false,[$korisnik[0]['ID']]);

    $xmlDom = new DOMDocument('1.0','UTF-8');

    $xmlRoot = $xmlDom->createElement("xml");
    $xmlRoot = $xmlDom->appendChild($xmlRoot);
    $file = "../../../../tablice/auth_blo_kat.xml";

    if($file) unlink($file);

    foreach($sql as &$r){
      $t1 = $r['naziv'];
      $t2 = $r['blokiran_do'];


      $element = $xmlDom->createElement("blokiran");
      $element = $xmlRoot->appendChild($element);
      $element->appendChild($xmlDom->createElement('kategorija',$t1));
      $element->appendChild($xmlDom->createElement('blokiran_do',$t2));

    }

    echo $xmlDom->save("../../../../tablice/auth_blo_kat.xml");
  } else { echo "problem z bazom (korisnik)";};

 ?>
