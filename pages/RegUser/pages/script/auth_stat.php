<?php
  include '../../../../globals/global.php';
  $dataB = new DB();
  @session_start();

  $korisnik = $dataB->query("SELECT * FROM korisnik WHERE korisnicko_ime = ?","s",false,[$_SESSION['username']]);

  if($korisnik){
    $sql = $dataB->query("SELECT * FROM vijest WHERE ID_statusa=? AND ID_autor = ?","ii",false,['3',$korisnik[0]['ID']]);

    $xmlDom = new DOMDocument('1.0','UTF-8');

    $xmlRoot = $xmlDom->createElement("xml");
    $xmlRoot = $xmlDom->appendChild($xmlRoot);
    $file = "../../../../tablice/auth_stat.xml";

    if($file) unlink($file);

    foreach($sql as &$r){
      echo var_dump($r);
      $t1 = $r['broj_pregleda'];
      $t2 = $r['naslov'];
      $t3 = $r['autori'];
      $t5 = $r['datum_objave'];


      $element = $xmlDom->createElement("vijest");
      $element = $xmlRoot->appendChild($element);
      $element->appendChild($xmlDom->createElement('pregledi',$t1));
      $element->appendChild($xmlDom->createElement('naslov',$t2));
      $element->appendChild($xmlDom->createElement('autori',$t3));
      $element->appendChild($xmlDom->createElement('datum',$t5));
    }

    echo $xmlDom->save("../../../../tablice/auth_stat.xml");
  } else { echo "problem z bazom (korisnik)";};

 ?>
