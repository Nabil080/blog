<?php


class ConnectBdd{
    public $bdd;

    public function __construct(){
        $user = "root";
        $pass = "";
        $host = "";
        $db = "romain";
        $this->bdd = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
}

?>