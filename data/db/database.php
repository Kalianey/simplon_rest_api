<?php

class Database
{

    private $host = "127.0.0.1";

    private $db_name = "simplon";

    private $username = "simplon";

    private $password = "simplon108";

    public $connexion;

    public function getConnection()
    {
        $this->connexion = null;
        try {
            $this->connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->connexion->exec("set contents utf8");
        } catch (PDOException $exception) {
            echo "Could not connect to Database: " . $exception->getMessage();
        }
        return $this->connexion;
    }
}
?>