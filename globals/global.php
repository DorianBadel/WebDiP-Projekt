<?php

function cleanUp(&$value, $id){
  $value = htmlspecialchars($value);
}


class DB{

  private $connection;

  public function __construct(){

    $database = "localhost";
    $db_name = "WebDiP2021x003";
    $db_user = "WebDiP2021x003";
    $db_pass = "admin_MFQi";

    $this->connection = @new mysqli($database, $db_name, $db_pass, $db_user);

    if(!$this->connection){
        throw new Exception("connection err");
    }

  }//CTOR

  public function __destruct(){
    $this->connection->close();
  }//DTOR

  public function query(string $sql, string $argTypes ="", bool $command = false, array $args = []){
    $prep = $this->connection->prepare($sql);

    if(!empty($argTypes))
      if($prep->bind_param($argTypes, ...$args) == false){
          throw new Exception("DB ".__line__."");
      }

    if(!$prep || !$prep->execute()){
      throw new Exception("DBA ".__line__."");
    }

    if(!$command){
      $data = $prep->get_result()->fetch_all(MYSQLI_ASSOC);

      array_walk_recursive($data, "cleanUp");

      return $data;
    } else {
      return $this->connection->insert_id;
    }
  } //QUERY


  public function exists(string $kor){
    return $this->query("SELECT EXISTS (SELECT * FROM korisnik WHERE korisnicko_ime = ?) as t", "s",false, [$kor])[0]["t"];


  }

  public function fetchId(){
    return mysqli_insert_id($this->connection);
  }

  public function getUloga(){
    @session_start();

    //if(file_exists("./role.xml")) unlink("./role.xml");

    if(isset($_SESSION['username'])){
      $sql = $this->query("SELECT ID_tipa_korisnika FROM korisnik WHERE korisnicko_ime= ?","s",false,[$_SESSION['username']]);
      $uloga = $sql[0]['ID_tipa_korisnika'];
    }
    else {
      $uloga = "1";
    }
    //$sql[0]["ID_tipa_korisnika"];

    $xmlDom = new DOMDocument('1.0','UTF-8');

    $xmlRoot = $xmlDom->createElement("xml");
    $xmlRoot = $xmlDom->appendChild($xmlRoot);

    $element = $xmlDom->createElement("korisnik");
    $element = $xmlRoot->appendChild($element);
    $element->appendChild($xmlDom->createElement('uloga',$uloga));

    $xmlDom->save("./role.xml");

  }

} //DB






?>
