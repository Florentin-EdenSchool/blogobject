<?php
class BDD
{
    static private $db;
    static private $username;
    static private $password;
    static private $host;

    public function __construct($db, $username, $password, $host)

    {
        self::$db = $db;
        self::$username = $username;
        self::$password = $password;
        self::$host = $host;
    }

    static function connect():PDO
    {
        $base = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$db, self::$username, self::$password);
        $base->exec("SET NAMES UTF8");
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        date_default_timezone_set('Europe/Paris');
        return $base;
    }
}
