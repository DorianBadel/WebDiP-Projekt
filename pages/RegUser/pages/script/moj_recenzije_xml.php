<?php
  include '../../../../globals/global.php';
  $dataB = new DB();
  @session_start();
  header("Content-Type: text/xml, charset=utf-8'");

  $korisnik = $dataB->query("SELECT * FROM korisnik WHERE korisnicko_ime = ?","s",false,[$_SESSION['username']]);

  if($korisnik){
    $sql = $dataB->query("SELECT `recenzija`.*, `tip_statusa`.*, `vijest`.`naslov`, `vijest`.`ID` as `VJid`
    FROM `vijest`
    LEFT JOIN `recenzija` ON `recenzija`.`ID_vijesti` = `vijest`.`ID`
    LEFT JOIN `tip_statusa` ON `vijest`.`ID_statusa` = `tip_statusa`.`ID`
    WHERE ID_autor = ?
    ","i",false,[$korisnik[0]['ID']]);

    $xmlDom = new DOMDocument('1.0','UTF-8');

    $xmlRoot = $xmlDom->createElement("xml");
    $xmlRoot = $xmlDom->appendChild($xmlRoot);


    foreach($sql as &$r){
      $t1 = $r['naslov'];
      $t2 = $r['naziv_statusa'];
      $t3 = $r['komentar'];
      $t4 = $r['VJid'];
      $t5 = $r['greske_cinjenicne'];
      $t6 = $r['greske_gramaticke'];
      $t7 = $r['nedostatak_reference'];
      $t8 = $r['nedostatak_materijala'];

      $sqlVj = $dataB->query("SELECT * FROM vijest WHERE ID =?",'i',false,[$t4]);


      $element = $xmlDom->createElement("recenzija");
      $element = $xmlRoot->appendChild($element);
      $element->appendChild($xmlDom->createElement('naslov',$t1));
      $element->appendChild($xmlDom->createElement('naziv_statusa',$t2));
      $element->appendChild($xmlDom->createElement('komentar',$t3));
      $element->appendChild($xmlDom->createElement('ID',$t4));
      $element->appendChild($xmlDom->createElement('greske_c',$t5));
      $element->appendChild($xmlDom->createElement('greske_g',$t6));
      $element->appendChild($xmlDom->createElement('nedostatak_ref',$t7));
      $element->appendChild($xmlDom->createElement('nedostatak_mat',$t8));


      $vjElement = $element->appendChild($xmlDom->createElement('vijest'));
      $vjElement->appendChild($xmlDom->createElement('tekst',$sqlVj[0]['tekst']));
      $vjElement->appendChild($xmlDom->createElement('autori',$sqlVj[0]['autori']));
      $vjElement->appendChild($xmlDom->createElement('izvor',$sqlVj[0]['url_za_izvor']));
      $vjElement->appendChild($xmlDom->createElement('slika',$sqlVj[0]['slika_src']));
      $vjElement->appendChild($xmlDom->createElement('zvuk',$sqlVj[0]['audio_src']));
      $vjElement->appendChild($xmlDom->createElement('video',$sqlVj[0]['video_src']));
      $vjElement->appendChild($xmlDom->createElement('verzija',$sqlVj[0]['verzija_vj']));

    }

    echo $xmlDom->saveXML();
  } else { echo "problem z bazom (korisnik)";};

 ?>
