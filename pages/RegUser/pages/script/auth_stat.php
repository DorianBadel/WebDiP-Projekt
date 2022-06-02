<?php
  include '../../../../globals/global.php';
  $dataB = new DB();
  @session_start();
  header("Content-Type: text/xml");


  $korisnik = $dataB->query("SELECT * FROM korisnik WHERE korisnicko_ime = ?","s",false,[$_SESSION['username']]);

  if($korisnik){
    $sql = $dataB->query("SELECT * FROM vijest WHERE ID_statusa=? AND ID_autor = ?","ii",false,['3',$korisnik[0]['ID']]);

    $xmlDom = new DOMDocument('1.0','UTF-8');

    $xmlRoot = $xmlDom->createElement("xml");
    $xmlRoot = $xmlDom->appendChild($xmlRoot);

    foreach($sql as &$r){
      $t1 = $r['broj_pregleda'];
      $t2 = $r['naslov'];
      $t3 = $r['autori'];
      $t5 = $r['datum_objave'];

      $g1 = $r['tekst'];
      $g2 = $r['slika_src'];


      $element = $xmlDom->createElement("vijest");
      $element = $xmlRoot->appendChild($element);
      $element->appendChild($xmlDom->createElement('pregledi',$t1));
      $element->appendChild($xmlDom->createElement('naslov',$t2));
      $element->appendChild($xmlDom->createElement('autori',$t3));
      $element->appendChild($xmlDom->createElement('datum',$t5));

      $element->appendChild($xmlDom->createElement('tekst',$g1));
      $element->appendChild($xmlDom->createElement('slika',$g2));

    }


    echo $xmlDom->saveXML();
    /*echo $xmlDom->save("../../../../tablice/auth_stat.xml");*/
  } else { echo "problem z bazom (korisnik)";};

 ?>
