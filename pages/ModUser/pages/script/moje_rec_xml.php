<?php
  include '../../../../globals/global.php';
  $dataB = new DB();
  @session_start();

  $korisnik = $dataB->query("SELECT * FROM korisnik WHERE korisnicko_ime = ?","i",false,[$_SESSION['username']]);

  $sql = $dataB->query("SELECT * FROM `vijest` WHERE `ID_recenzenta` = ? AND
NOT EXISTS ( SELECT * FROM blokiran WHERE `ID_korisnika` = ? AND `ID_kategorije` = `vijest`.`ID_kategorije`) AND `ID_statusa` = ?","iii",false,[$korisnik[0]['ID'],$korisnik[0]['ID'],'1']);


  $xmlDom = new DOMDocument('1.0','UTF-8');

  $xmlRoot = $xmlDom->createElement("xml");
  $xmlRoot = $xmlDom->appendChild($xmlRoot);
  $file = "../../../../tablice/moje_rec.xml";

  if($file) unlink($file);

  foreach($sql &$r){

    $t2 = $r['naslov'];
    $t3 = $r['autori'];
    $t4 = $r['url_za_izvor'];
    $t5 = $r['datum_objave'];
    $t6 = $r['verzija_vj'];

    $g1 = $r['tekst'];

    $g2 = $r['slika_src'];

    $element = $xmlDom->createElement("vijest");
    $element = $xmlRoot->appendChild($element);

    $element->appendChild($xmlDom->createElement('naslov',$t2));
    $element->appendChild($xmlDom->createElement('autori',$t3));
    $element->appendChild($xmlDom->createElement('izvor',$t4));
    $element->appendChild($xmlDom->createElement('datum',$t5));
    $element->appendChild($xmlDom->createElement('verzija',$t6));
    $element->appendChild($xmlDom->createElement('tekst',$g1));
    $element->appendChild($xmlDom->createElement('slika',$g2));
  }

  echo $xmlDom->save("../../../../tablice/moje_rec.xml");

 ?>
