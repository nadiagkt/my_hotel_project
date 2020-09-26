<?php

namespace Hotel;

use PDO;
use Support\Configuration\Configuration;

class BaseService{

    private static $pdo;

    public function __construct(){
        $this->initializePdo();
    }

    protected function initializePdo(){

        
        if(!empty(self::$pdo)){
            return;
        }

        $config = Configuration::getInstance();
        $databaseConfig = $config->getConfig()['database'];

        try{
            self::$pdo = new PDO(sprintf('mysql:host=%s;dbname=%s;charset=UTF8', $databaseConfig['host'], $databaseConfig['dbname']), $databaseConfig['username'], $databaseConfig['password'], [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"]);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (\PDOException $ex){
            throw new \Exception(sprintf('Could not connect to database. Error: %s', $ex->getMessage()));
        }
       
    }

    protected function execute($sql, $parameters){
         
         $statement = $this->getPdo()->prepare($sql);

       
        foreach ($parameters as $key => $value){
            $statement->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
       
        $status = $statement->execute();
        if(!$status){
            throw new \Exception($statement->errorInfo()[2]);
        }

        return $status;
    }

    protected function fetchAll($sql, $parameters= [], $type = PDO::FETCH_ASSOC){
        
        $statement = $this->getPdo()->prepare($sql);

        
        foreach ($parameters as $key => $value){
            $statement->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }

        $status = $statement->execute();
        if(!$status){
            throw new \Exception($statement->errorInfo()[2]);
        }

        return $statement->fetchAll($type);
    }

    protected function fetch($sql, $parameters= [], $type = PDO::FETCH_ASSOC){
        
        $statement = $this->getPdo()->prepare($sql);
       
        foreach ($parameters as $key => $value){
            $statement->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }

        $status = $statement->execute();

        return $statement->fetch($type);
    }

    protected function getPdo(){
        return self::$pdo;
    }
}
?>