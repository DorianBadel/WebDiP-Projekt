<?php
include 'global.php';
@session_start();
  header("Content-Type: text/xml");


if(isset($_SESSION['username'])){
  $sql = $this->query("SELECT ID_tipa_korisnika FROM korisnik WHERE korisnicko_ime= ?","s",false,[$_SESSION['username']]);
  $uloga = $sql[0]['ID_tipa_korisnika'];
}
else {
  $uloga = "1";
}

$xmlDom = new DOMDocument('1.0','UTF-8');

$xmlRoot = $xmlDom->createElement("xml");
$xmlRoot = $xmlDom->appendChild($xmlRoot);

$element = $xmlDom->createElement("korisnik");
$element = $xmlRoot->appendChild($element);
$element->appendChild($xmlDom->createElement('uloga',$uloga));

$xmlDom->saveXML();

 ?>
