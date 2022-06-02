<?php
  include '../../../../globals/global.php';
  $dataB = new DB();

  $sql = $dataB->query("SELECT * FROM vijest WHERE ID_recenzenta IS NULL");

  $xmlDom = new DOMDocument('1.0','UTF-8');

  $xmlRoot = $xmlDom->createElement("xml");
  $xmlRoot = $xmlDom->appendChild($xmlRoot);
  $file = "../../../../tablice/vj_za_rec.xml";

  if($file) unlink($file);

  foreach($sql as &$r){

    $kat = $dataB->query("SELECT * FROM kategorija WHERE ID = ?","i",false,[$r['ID_kategorije']]);
    $kor = $dataB->query("SELECT * FROM korisnik WHERE ID = ?","i",false,[$r['ID_autor']]);

    $t1 = $r['naslov'];
    $t2 = $kat[0]['naziv'];
    $t3 = $kor[0]['korisnicko_ime'];

    $element = $xmlDom->createElement("vijest");
    $element = $xmlRoot->appendChild($element);

    $element->appendChild($xmlDom->createElement('naslov',$t1));
    $element->appendChild($xmlDom->createElement('autor',$t2));
    $element->appendChild($xmlDom->createElement('kategorija',$t3));
    $element->appendChild($xmlDom->createElement('korisnicko_ime',$t3));

  }

  echo $xmlDom->save("../../../../tablice/vj_za_rec.xml");

 ?>
