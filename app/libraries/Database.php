<?php
/*
 * PDO Database class
 * connect to database
 * create prepared statment
 * bind values
 * return rows and results
 */

class Database
{
    private $host = DB_HOST;
    private $user = DB_USERNAME;
    private $dbname = DB_NAME;
    private $password = DB_PASSWORD;

    private $dbHandler;
    private $stmt;
    private $error;


    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create a PDO Instance

        try {
            $this->dbHandler = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Prepared Statement with query
    public function query($sql)
    {
        $this->stmt = $this->dbHandler->prepare($sql);
    }

    // Bind Values
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepare statment
    public function executePrepareStmt()
    {
        return $this->stmt->execute();
    }

    // Get result set as array of objects
    public function resultSet()
    {

        $this->executePrepareStmt();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get result record as single object
    public function singleResult()
    {
        $this->executePrepareStmt();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get Row count
    public function rowCount()
    {
        $this->executePrepareStmt();
        return $this->stmt->rowCount();
    }
}
