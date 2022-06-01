<?php
  include '../../../../globals/global.php';
  $dataB = new DB();

  $sql = $dataB->query("SELECT * FROM kategorija");


  $xmlDom = new DOMDocument('1.0','UTF-8');

  $xmlRoot = $xmlDom->createElement("xml");
  $xmlRoot = $xmlDom->appendChild($xmlRoot);
  $file = "../../../../tablice/kategorije.xml";

  if($file) unlink($file);

  foreach($sql as &$r){
    $t1 = $r['naziv'];
    $t2 = $r['sazetak'];
    $t3 = $r['opis'];

    $element = $xmlDom->createElement("korisnik");
    $element = $xmlRoot->appendChild($element);

    $element->appendChild($xmlDom->createElement('naziv',$t1));
    $element->appendChild($xmlDom->createElement('sazetak',$t2));
    $element->appendChild($xmlDom->createElement('opis',$t3));

  }

  echo $xmlDom->save("../../../../tablice/kategorije.xml");

 ?>
