<?php 

namespace app\core;

abstract class Model 
{
    protected Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    private function getKeysFromModels() : array
    {
        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties();

        $array = array_map(fn($property) => $property->getName(), $properties);

        // we need to delete the property "database"
        array_pop($array);

        return $array;
    }

    private function checkIfArrayKeyExists(array $params) : bool
    {
        $modelKeys = $this->getKeysFromModels();
        $paramsKeys = array_keys($params);

        sort($modelKeys);
        sort($paramsKeys);

        return $modelKeys === $paramsKeys;
    }

    private function generateTableDatabase()
    {
        $reflection = new \ReflectionClass($this);
        $table = \strtolower($reflection->getShortName());       
        return $table ."s";
    }

    public function all()
    {
        return $this->database->all($this->generateTableDatabase());
    }

    public function add(array $params)
    {        
      if(!$this->checkIfArrayKeyExists($params)){
        http_response_code(500);
        $vars = ["message" => "Something wrong happend"];
        require_once "helpers/index.php";
      }

        // Processing the storing
        $this->database->store($this->generateTableDatabase(),$params);
    }
}