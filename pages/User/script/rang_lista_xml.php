<?php
  include '../../../globals/global.php';
  $dataB = new DB();

  $sql = $dataB->query("SELECT * FROM vijest WHERE ID_statusa=?","i",false,['3']);
  //$connection->set_charset('utf8');
  //$exec = mysqli_query($connection, $sql);

  $xmlDom = new DOMDocument('1.0','UTF-8');

  $xmlRoot = $xmlDom->createElement("xml");
  $xmlRoot = $xmlDom->appendChild($xmlRoot);
  $file = "../../../tablice/rang_lista.xml";

  if($file) unlink($file);

  foreach($sql as &$r){
    echo var_dump($r);
    $t1 = $r['broj_pregleda'];
    $t2 = $r['naslov'];
    $t3 = $r['autori'];
    $t4 = $r['url_za_izvor'];
    $t5 = $r['datum_objave'];
    $t6 = $r['verzija_vj'];

    $g1 = $r['tekst'];

    $g2 = $r['slika_src'];
    //substr(((string)$r['tekst_clanka']),0,10)


    $element = $xmlDom->createElement("vijest");
    $element = $xmlRoot->appendChild($element);
    $element->appendChild($xmlDom->createElement('pregledi',$t1));
    $element->appendChild($xmlDom->createElement('naslov',$t2));
    $element->appendChild($xmlDom->createElement('autori',$t3));
    $element->appendChild($xmlDom->createElement('izvor',$t4));
    $element->appendChild($xmlDom->createElement('datum',$t5));
    $element->appendChild($xmlDom->createElement('verzija',$t6));
    $element->appendChild($xmlDom->createElement('tekst',$g1));
    $element->appendChild($xmlDom->createElement('slika',$g2));
  }

  echo $xmlDom->save("../../../tablice/rang_lista.xml");

 ?>
