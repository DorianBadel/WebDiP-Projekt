<?php
  include '../../../globals/global.php';
  $sql = "SELECT * FROM vijest WHERE ID_statusa='3'";
  $connection->set_charset('utf8');
  $exec = mysqli_query($connection, $sql);

  $xmlDom = new DOMDocument('1.0','UTF-8');

  $xmlRoot = $xmlDom->createElement("xml");
  $xmlRoot = $xmlDom->appendChild($xmlRoot);

  while($r = mysqli_fetch_assoc($exec)){
    $t1 = $r['broj_pregleda'];
    $t2 = $r['naslov'];
    $t3 = $r['autori'];
    $t4 = $r['url_za_izvor'];
    $t5 = $r['datum_objave'];
    $t6 = $r['broj_pregleda'];
    $t7 = $r['verzija_vj'];

    $element = $xmlDom->createElement("vijest");
    $element = $xmlRoot->appendChild($element);
    $element->appendChild($xmlDom->createElement('pregledi',$t1));
    $element->appendChild($xmlDom->createElement('naslov',$t2));
    $element->appendChild($xmlDom->createElement('autori',$t3));
    $element->appendChild($xmlDom->createElement('izvor',$t4));
    $element->appendChild($xmlDom->createElement('datum',$t5));
    $element->appendChild($xmlDom->createElement('verzija',$t6));
  }

  echo $xmlDom->save("../../../tablice/rang_lista.xml");

 ?>
