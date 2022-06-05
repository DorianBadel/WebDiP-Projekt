<?php
if(isset($_POST['submit']) && !empty($_POST['kategorija']) && !empty($_POST['sazetak'])){
  $kategorija = $_POST['kategorija'];
  $sazetak = $_POST['sazetak'];
  $opis = $_POST['opis'];

  $dataB = new DB();


  $dataB->query("INSERT INTO kategorija (`naziv`,`sazetak`,`opis`) VALUES (?,?,?)","sss",true,[$kategorija,$sazetak,$opis]);
}

if(isset($_POST['edit']) && !empty($_POST['kategorija']) && !empty($_POST['sazetak']) && !empty($_POST['ind'])){
  $kategorija = $_POST['kategorija'];
  $sazetak = $_POST['sazetak'];
  $opis = $_POST['opis'];

  $dataB = new DB();


  $dataB->query("UPDATE kategorija
    SET `naziv`=?,`sazetak`=?,`opis`=?
    WHERE ID = ?","sssi",true,[$kategorija,$sazetak,$opis,$_POST['ind']]);
}

if(isset($_POST['modAdd']) && !empty($_POST['kategorija']) && !empty($_POST['sazetak']) && !empty($_POST['mod'])){
  $kategorija = $_POST['kategorija'];
  $sazetak = $_POST['sazetak'];
  $opis = $_POST['opis'];
  $mod = $_POST['mod'];

  $dataB = new DB();


  $dataB->query("INSERT INTO kategorija (`naziv`,`sazetak`,`opis`) VALUES (?,?,?)","sss",true,[$kategorija,$sazetak,$opis]);

  $ID_kategorije = $dataB->fetchId();

  $dataB->query("INSERT INTO `pripada` (`ID_korisnika`, `ID_kategorije`, `jeModerator`) VALUES (?, ?, ?);","iii",true,[$mod,$ID_kategorije,'1']);
}
?>
