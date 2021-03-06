<?php
class Database
{

    /* Live
    private $host = "localhost";
    private $db_name = "shaunqua_showcase";
    private $username = "shaunqua_sqadmin";
    private $password = "Mvccocc23";
     */

    private $host = "localhost";
    private $db_name = "shaunqua_showcase";
    private $username = "root";
    private $password = "";
    public $conn;

    public function dbConnection()
    {

        $this->conn = null;
        try
        {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception)
        {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}