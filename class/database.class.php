<?php
class database
{
    public $server = '127.0.0.1';
    public $username = 'komis';
    public $password = 'komis';
    public $database = 'komis';
    public $pdo;

    public function __construct()
    {
        $this->openConnection();
    }
    public function openConnection()
    {
        try {
            $this->pdo = new PDO('mysql:host='.$this->server.';dbname='.$this->database.'', $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $error)
        {
            die("Connection to database failed because: " . $error->getMessage());
        }
    }
}
?>

