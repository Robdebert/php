<?php

class HelloWorld
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function createDBIFNotExists() {
        $sql = "CREATE DATABASE IF NOT EXISTS hello;";
        $result = $this->pdo->query($sql);
        return (bool) $result;
    }
    public function createTableIFNotExists() {
        $sql = "CREATE TABLE IF NOT EXISTS `world` ( `what` VARCHAR(255) NOT NULL , PRIMARY KEY (`what`)) ENGINE = InnoDB;";
        $result = $this->pdo->prepare($sql)->execute();
        return (bool) $result;
    }

    public function insert($message)
    {
        $sql = "INSERT INTO world VALUES ('{$message}')";
		$sth = $this->pdo->prepare($sql);
        $result = $sth->execute();
        return (bool) $result;
    }


    public function getAll()
    {
        $sql = "SELECT * FROM world";
        $sth = $this->pdo->prepare($sql);
		$sth->execute();
		$result_array = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result_array;
    }
}
