<?php
  include '../../../../globals/global.php';
  $dataB = new DB();
  header("Content-Type: text/xml");

  $sql = $dataB->query("SELECT * FROM kategorija");


  $xmlDom = new DOMDocument('1.0','UTF-8');

  $xmlRoot = $xmlDom->createElement("xml");
  $xmlRoot = $xmlDom->appendChild($xmlRoot);

  foreach($sql as &$r){
    $t1 = $r['naziv'];
    $t2 = $r['sazetak'];
    $t3 = $r['opis'];
    $t4 = $r['ID'];

    $element = $xmlDom->createElement("kategorija");
    $element = $xmlRoot->appendChild($element);

    $element->appendChild($xmlDom->createElement('naziv',$t1));
    $element->appendChild($xmlDom->createElement('sazetak',$t2));
    $element->appendChild($xmlDom->createElement('opis',$t3));
    $element->appendChild($xmlDom->createElement('id',$t4));

  }

  echo $xmlDom->saveXML();

 ?>
