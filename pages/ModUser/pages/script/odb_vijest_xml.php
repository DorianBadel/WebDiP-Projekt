<?php
  include '../../../../globals/global.php';
  $dataB = new DB();

  $sql= $dataB->query("SELECT * FROM vijest WHERE ID_statusa = ?","i",false,['4']);

  $xmlDom = new DOMDocument('1.0','UTF-8');

  $xmlRoot = $xmlDom->createElement("xml");
  $xmlRoot = $xmlDom->appendChild($xmlRoot);
  $file = "../../../../tablice/odb_vijesti.xml";

  if($file) unlink($file);



  foreach($sql as &$r){

    $korisnik = $dataB->query("SELECT * FROM korisnik WHERE ID =?","i",false,[$r['ID_autor']]);

    $t1 = $korisnik[0]['korisnicko_ime'];
    $t2 = $r['naslov'];
    $t3 = $r['datum_objave'];

    $element = $xmlDom->createElement("blokiran");
    $element = $xmlRoot->appendChild($element);

    $element->appendChild($xmlDom->createElement('korisnik',$t1));
    $element->appendChild($xmlDom->createElement('naslov',$t2));
    $element->appendChild($xmlDom->createElement('datum_objave',$t3));

  }

  echo $xmlDom->save("../../../../tablice/odb_vijesti.xml");

 ?>
