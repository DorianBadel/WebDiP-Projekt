<?php
  include '../../../../globals/global.php';
  $dataB = new DB();
  header("Content-Type: text/xml");


  $autori = $dataB->query("SELECT * FROM `korisnik` WHERE `ID_tipa_korisnika` > 1");


    $xmlDom = new DOMDocument('1.0','UTF-8');

  $xmlRoot = $xmlDom->createElement("xml");
  $xmlRoot = $xmlDom->appendChild($xmlRoot);

  foreach($autori as &$a){


    $q1 = $dataB->query("SELECT COUNT(ID_statusa) as num FROM `vijest` WHERE `ID_autor`= ? AND `ID_statusa`= '3'","i",false,[$a['ID']]);
    $t1 = $q1[0]['num'];
    $q2 = $dataB->query("SELECT COUNT(ID_statusa) as num FROM `vijest` WHERE `ID_autor`= ? AND `ID_statusa`= '4'","i",false,[$a['ID']]);
    $t2 = $q2[0]['num'];

    $element = $xmlDom->createElement("brVijesti");
    $element = $xmlRoot->appendChild($element);

    $element->appendChild($xmlDom->createElement('korisnik',$a['korisnicko_ime']));
    $element->appendChild($xmlDom->createElement('br_pr',$t1));
    $element->appendChild($xmlDom->createElement('br_odb',$t2));

  }

  echo $xmlDom->saveXML();

 ?>
