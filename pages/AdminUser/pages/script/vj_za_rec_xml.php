<?php
  include '../../../../globals/global.php';
  $dataB = new DB();
  header("Content-Type: text/xml");

  /*$sql = $dataB->query("SELECT * FROM vijest WHERE ID_recenzenta IS NULL AND ID_statusa = '1' OR ID_statusa = '2'");*/
  $sql = $dataB->query("SELECT * FROM vijest WHERE ID_statusa = '1'");

  $xmlDom = new DOMDocument('1.0','UTF-8');

  $xmlRoot = $xmlDom->createElement("xml");
  $xmlRoot = $xmlDom->appendChild($xmlRoot);

  foreach($sql as &$r){

    $kat = $dataB->query("SELECT * FROM kategorija WHERE ID = ?","i",false,[$r['ID_kategorije']]);
    $kor = $dataB->query("SELECT * FROM korisnik WHERE ID = ?","i",false,[$r['ID_autor']]);

    $t1 = $r['naslov'];
    $t2 = $kat[0]['naziv'];
    $t3 = $kor[0]['korisnicko_ime'];
    $t4 = $r['ID'];
    $t5 = $r['ID_kategorije'];

    $element = $xmlDom->createElement("vijest");
    $element = $xmlRoot->appendChild($element);

    $element->appendChild($xmlDom->createElement('naslov',$t1));
    $element->appendChild($xmlDom->createElement('autor',$t2));
    $element->appendChild($xmlDom->createElement('kategorija',$t3));
    $element->appendChild($xmlDom->createElement('id_vj',$t4));
    $element->appendChild($xmlDom->createElement('id_kat',$t5));

  }

  echo $xmlDom->saveXML();

 ?>
