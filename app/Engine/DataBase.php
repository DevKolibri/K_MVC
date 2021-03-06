<?
namespace app\Engine;

use PDO;

class DataBase
{   
    private static $type = null;
    private static $host = null;
    private static $user = null;
    private static $pass = null;
    private static $dbname = null;
    private static $dbh = null;
    private static $error = null;

    public function __construct(){

       $dbconfig = require 'config/dbconfig.php';
        
        $this->type = $dbconfig['type'];
        $this->host = $dbconfig['host'];
        $this->user = $dbconfig['user'];
        $this->pass = $dbconfig['password'];
        $this->dbname = $dbconfig['table'];
        $dsn = $this->type .':host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8';
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            
        } catch (PDOException $e) {
            $this->error = $e->__toString();
        }
    }

    public function __destruct()
    {
        $this->dbh = null;
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function resultset()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
 
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
}
?>