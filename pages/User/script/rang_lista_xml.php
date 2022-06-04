<?php
  include '../../../globals/global.php';
  $dataB = new DB();
  header("Content-Type: text/xml");


  $sql = $dataB->query("SELECT * FROM vijest WHERE ID_statusa = ?","i",false,['3']);

  $xmlDom = new DOMDocument('1.0','UTF-8');

  $xmlRoot = $xmlDom->createElement("xml");
  $xmlRoot = $xmlDom->appendChild($xmlRoot);

  foreach($sql as &$r){
    $t0 = $r['ID'];
    $t1 = $r['broj_pregleda'];
    $t2 = $r['naslov'];
    $t3 = $r['autori'];
    $t5 = $r['datum_objave'];
    $t6 = $r['ID_statusa'];
    $t7 = $r['ID_kategorije'];

    $g1 = $r['tekst'];
    $g2 = $r['slika_src'];

    $e1 = $r['url_za_izvor'];
    $e2 = $r['verzija_vj'];
    $e3 = $r['video_src'];
    $e4 = $r['audio_src'];


    $element = $xmlDom->createElement("vijest");
    $element = $xmlRoot->appendChild($element);
    $element->appendChild($xmlDom->createElement('ID',$t0));
    $element->appendChild($xmlDom->createElement('pregledi',$t1));
    $element->appendChild($xmlDom->createElement('naslov',$t2));
    $element->appendChild($xmlDom->createElement('autori',$t3));
    $element->appendChild($xmlDom->createElement('datum',$t5));
    $element->appendChild($xmlDom->createElement('status',$t6));
    $element->appendChild($xmlDom->createElement('kategorija',$t7));

    $element->appendChild($xmlDom->createElement('tekst',$g1));
    $element->appendChild($xmlDom->createElement('slika',$g2));

    $element->appendChild($xmlDom->createElement('izvor',$e1));
    $element->appendChild($xmlDom->createElement('verzija',$e2));
    $element->appendChild($xmlDom->createElement('video',$e3));
    $element->appendChild($xmlDom->createElement('audio',$e4));

  }


  echo $xmlDom->saveXML();

 ?>
