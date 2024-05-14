<?php
require_once('config.php');
class Database{
    public $dbConnection;
    public function __construct()
    {
        $this->dbConnection = new \mysqli(
            DB_HOST,
            DB_USER,
            DB_PASS,
            DB_NAME
        );
        mysqli_set_charset($this->dbConnection, 'utf8');
    }
    public function query($sql)
    {
        $res = mysqli_query($this->dbConnection, $sql);
        if (!$res) {
            throw new Exception("Error en la consulta: " . mysqli_error($this->dbConnection));
        }
        return $res;
    }
    public function checkConnection()
    {
        if ($this->dbConnection->connect_error) {
            die("Error de conexión: " . $this->dbConnection->connect_error);
        } else {
            echo "Conexión exitosa a la BD.";
        }
    }
}
