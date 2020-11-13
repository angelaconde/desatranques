<?php

class DB
{

    protected static $con;

    protected function __construct()
    {
    }

    public static function getcon()
    {

        if (empty(self::$con)) {

            include __DIR__ . '/../config.php';

            try {
                self::$con = new PDO("mysql:host=" . $db_info['db_host'] . ';dbname=' . $db_info['db_name'], $db_info['db_user'], $db_info['db_pass']);
                self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                self::$con->query('SET NAMES utf8');
                self::$con->query('SET CHARACTER SET utf8');
            } catch (PDOException $error) {
                echo $error->getMessage();
            }
        }

        return self::$con;
    }
}
