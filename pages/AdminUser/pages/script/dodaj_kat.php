<?php
if(isset($_POST['submit']) && !empty($_POST['kategorija']) && !empty($_POST['sazetak'])){
  $kategorija = $_POST['kategorija'];
  $sazetak = $_POST['sazetak'];
  $opis = $_POST['opis'];

  $dataB = new DB();

  echo "dodana kategorija";

  try {
    $dataB->query("INSERT INTO kategorija (`naziv`,`sazetak`,`opis`) VALUES (?,?,?)","sss",true,[$kategorija,$sazetak,$opis]);

  } catch (Exception $e) {
      echo "<script>alert('problem')</script>";
  }

}

if(isset($_POST['edit'])&& !empty($_POST['kategorija_edit']) && !empty($_POST['sazetak_edit'])){
  $kategorija = $_POST['kategorija_edit'];
  $sazetak = $_POST['sazetak_edit'];
  $opis = $_POST['opis_edit'];
  $index = $_POST['ind'];

  $dataB = new DB();

  echo "azurirana kategorija";


  $dataB->query("UPDATE kategorija SET
    `naziv`=?,
    `sazetak`=?,
    `opis`=?
    WHERE ID = ?","sssi",true,[$kategorija,$sazetak,$opis,$index]);
}

if(isset($_POST['del'])){
  $index = $_POST['ind'];

  $dataB = new DB();

  echo "uspjesno izbrisano";

  $dataB->query("DELETE FROM pripada WHERE ID_kategorije = ?","i",true,[$index]);
  $dataB->query("DELETE FROM kategorija WHERE ID = ?","i",true,[$index]);
}


if(isset($_POST['modAdd'])){
  $kategorija = $_POST['indkat'];
  $mod = $_POST['mod'];

  $dataB = new DB();

  echo "dodan moderator";
  if($dataB->query("SELECT EXISTS (SELECT * FROM pripada WHERE ID_korisnika = ? AND ID_kategorije = ?) as postoji","ii",false,[$mod,$kategorija])[0]['postoji']){
    $dataB->query("UPDATE `pripada` SET `jeModerator`=? WHERE ID_korisnika=? AND ID_kategorije = ?","iii",true,['1',$mod,$kategorija]);
  }else{
    $dataB->query("INSERT INTO `pripada` (`ID_korisnika`, `ID_kategorije`, `jeModerator`) VALUES (?, ?, ?);","iii",true,[$mod,$kategorija,'1']);

  }
}
?>
