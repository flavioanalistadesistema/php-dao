<?php

class Sql extends PDO {

    private $conn;

    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=dbphp7';
        $username = 'root';
        $password = 'MeuBebeG12';
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        ); 
        $this->conn = new PDO($dsn, $username, $password, $options);
        if (!$this->conn) {
            echo 'Erro connection database';
            exit;
        }
    }

    private function setParams($stmt, $params = array())
    {
        foreach($params as $key => $value) {
            
            return $this->setParam($stmt, $key, $value);
        }
    }

    private function setParam($stmt, $key, $value)
    {
        return $stmt->bindParam($key, $value);
    }

    public function query($rawQuery, $params = array())
    {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($rawQuery, $params);

        $stmt->execute();
        return $stmt;
    }

    public function select($rawQuery, $params = array()):array
    {
        $stmt = $this->query($rawQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}