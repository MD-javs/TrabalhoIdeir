<?php
final class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $config = parse_ini_file(__DIR__ . '/../config.ini', true);

        $dbDriver = $config['database']['driver'] ?? 'mysql';
        $dbHost = $config['database']['host'] ?? 'localhost';
        $dbName = $config['database']['dbname'] ?? '';
        $dbUser = $config['database']['user'] ?? 'root';
        $dbPass = $config['database']['password'] ?? '';

        $dsn = "$dbDriver:host=$dbHost;dbname=$dbName;charset=utf8";

        $this->connection = new PDO($dsn, $dbUser, $dbPass);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
