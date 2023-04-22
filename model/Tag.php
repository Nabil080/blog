<?php
require_once('config/ConnectBdd.php');
require_once('config/functions.php');

class Tag{
    public $id;
    public $name;
    
    public function createToInsert(array $categoryForm):bool{

        $this->name = $categoryForm['name'];

        return true;
    }
}

class TagRepository extends ConnectBdd{

    public function __construct(){
        parent::__construct();
    }
}



?>