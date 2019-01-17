<?php

/**
 * Class DB
 */
class DB
{

    /**
     * @var null
     */
    private static $pdo = null;

    /**
     * @return null|PDO
     */
    public function getConnection()
    {
        if (!self::$pdo) {
            $dsn = 'mysql:host='. MYSQL_HOST .';port='. MYSQL_PORT .';dbname='. DB_NAME . ';charset=utf8';
            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            );
            try {
                self::$pdo = new PDO($dsn, DB_USERNAME , DB_PASSWORD, $options);
                print_r(self::$pdo);
            } catch (PDOException $e) {
                echo "Connection failed: ".$e->getMessage();
                exit();
            }
        }
        return self::$pdo;
    }

    /**
     * @param $sql
     * @param array $parameters
     * @return array|bool
     */
    public function query($sql, $parameters = [])
    {
        $dbh = $this->getConnection();
        $stmt = $dbh->prepare($sql);
        $result = $stmt->execute($parameters);

        if ($result !== false)
        {
            try {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                return true;
            }
        }
        else
        {
            return false;
        }
    }

}