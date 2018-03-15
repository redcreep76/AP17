<?php

class Database
{
    private $host = "localhost";
    private $dbname = "AP17";
    private $user = "AP17";
    private $password = "viacesi";
    private $pdo;

    function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=UTF8", $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            Log::logWrite($e->getMessage());
        }
    }

    function execute($data)
    {
        $req = $this->pdo->prepare($data);
        try {
            return $req->execute();
        }
        catch (PDOException $e) {
            Log::logWrite($e->getMessage());
        }
        return false;
    }

    function query($data)
    {
        try {

            return $this->pdo->query($data);
        }
        catch (PDOException $e) {
            Log::logWrite($e->getMessage());
        }
        return false;
    }

    function getLastInsertId() {
        return $this->pdo->lastInsertId();
    }

    function __destruct()
    {
        unset($this->pdo);
    }
}