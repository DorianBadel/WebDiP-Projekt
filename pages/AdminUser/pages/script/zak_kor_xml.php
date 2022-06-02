<?php
  include '../../../../globals/global.php';
  $dataB = new DB();

  $sql = $dataB->query("SELECT * FROM korisnik WHERE br_neuspj_unosa = ?","i",false,['4']);


  $xmlDom = new DOMDocument('1.0','UTF-8');

  $xmlRoot = $xmlDom->createElement("xml");
  $xmlRoot = $xmlDom->appendChild($xmlRoot);
  $file = "../../../../tablice/zak_kor.xml";

  if($file) unlink($file);

  foreach($sql as &$r){

    $t1 = $r['prezime'];
    $t2 = $r['ime'];
    $t3 = $r['korisnicko_ime'];
    $t4 = $r['email'];

    $element = $xmlDom->createElement("zakljucan");
    $element = $xmlRoot->appendChild($element);

    $element->appendChild($xmlDom->createElement('ime',$t2));
    $element->appendChild($xmlDom->createElement('prezime',$t1));
    $element->appendChild($xmlDom->createElement('email',$t4));
    $element->appendChild($xmlDom->createElement('korisnicko_ime',$t3));

  }

  echo $xmlDom->save("../../../../tablice/zak_kor.xml");

 ?>
