<?php
  include '../../../../globals/global.php';
  $dataB = new DB();

  header("Content-Type: text/xml");

  $sql= $dataB->query("SELECT * FROM vijest WHERE ID_statusa = ?","i",false,['4']);

  $xmlDom = new DOMDocument('1.0','UTF-8');

  $xmlRoot = $xmlDom->createElement("xml");
  $xmlRoot = $xmlDom->appendChild($xmlRoot);



  foreach($sql as &$r){

    $korisnik = $dataB->query("SELECT * FROM korisnik WHERE ID =?","i",false,[$r['ID_autor']]);
    $kategorija = $dataB->query("SELECT * FROM kategorija WHERE ID =?","i",false,[$r['ID_kategorije']]);

    $t1 = $korisnik[0]['korisnicko_ime'];
    $t2 = $r['naslov'];
    $t3 = $r['datum_objave'];
    $t4 = $kategorija[0]['naziv'];

    $element = $xmlDom->createElement("blokiran");
    $element = $xmlRoot->appendChild($element);

    $element->appendChild($xmlDom->createElement('korisnik',$t1));
    $element->appendChild($xmlDom->createElement('naslov',$t2));
    $element->appendChild($xmlDom->createElement('datum_objave',$t3));
    $element->appendChild($xmlDom->createElement('naziv',$t4));

  }

  echo $xmlDom->saveXML();

 ?>
