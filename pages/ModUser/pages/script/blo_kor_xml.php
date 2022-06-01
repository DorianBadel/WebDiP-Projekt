<?php
  include '../../../../globals/global.php';
  $dataB = new DB();

  $korisnik_ID = $dataB->query("SELECT * FROM blokiran");


  $xmlDom = new DOMDocument('1.0','UTF-8');

  $xmlRoot = $xmlDom->createElement("xml");
  $xmlRoot = $xmlDom->appendChild($xmlRoot);
  $file = "../../../../tablice/blok_kor.xml";

  if($file) unlink($file);

  $element = $xmlDom->createElement("blokiran");
  $element = $xmlRoot->appendChild($element);

  foreach($korisnik_ID as &$r){

    $korisnik = $dataB->query("SELECT * FROM korisnik WHERE ID =?","i",false,[$r['ID_korisnika']]);

    $t1 = $korisnik[0]['korisnicko_ime'];
    $t2 = $r['razlog_blokiranja'];

    $element->appendChild($xmlDom->createElement('korisnik',$t1));
    $element->appendChild($xmlDom->createElement('razlog',$t2));

  }

  echo $xmlDom->save("../../../../tablice/blok_kor.xml");

 ?>
