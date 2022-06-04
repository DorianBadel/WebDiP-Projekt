<?php
  include '../../../../globals/global.php';
  $dataB = new DB();
  header("Content-Type: text/xml");

  $blok = $dataB->query("SELECT * FROM blokiran");


  $xmlDom = new DOMDocument('1.0','UTF-8');

  $xmlRoot = $xmlDom->createElement("xml");
  $xmlRoot = $xmlDom->appendChild($xmlRoot);

  foreach($blok as &$r){

    $korisnik = $dataB->query("SELECT * FROM korisnik WHERE ID =?","i",false,[$r['ID_korisnika']]);
    $kat= $dataB->query("SELECT * FROM kategorija WHERE ID =?","i",false,[$r['ID_kategorije']]);

    $t1 = $korisnik[0]['korisnicko_ime'];
    $t2 = $r['razlog_blokiranja'];
    $t3 = $r['blokiran_od'];
    $t4 = $r['blokiran_do'];
    $t5 = $kat[0]['naziv'];

    $element = $xmlDom->createElement("blokiran");
    $element = $xmlRoot->appendChild($element);

    $element->appendChild($xmlDom->createElement('korisnik',$t1));
    $element->appendChild($xmlDom->createElement('razlog',$t2));
    $element->appendChild($xmlDom->createElement('naziv',$t5));
    $element->appendChild($xmlDom->createElement('blokiran_od',$t3));
    $element->appendChild($xmlDom->createElement('blokiran_do',$t4));

  }

  echo $xmlDom->saveXML();
 ?>
