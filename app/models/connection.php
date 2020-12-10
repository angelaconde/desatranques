<?php

/**
 * Modelo de conexión a la base de datos con patrón Singleton
 * 
 * @author Angela Conde
 */

/**
 * Clase DB
 */
class DB
{
    protected static $con;

    /**
     * Constructor de la clase DB
     * Protegido para el patrón Singleton
     */
    protected function __construct()
    {
    }

    /**
     * Devuelve una instancia de la conexión a la base de datos
     * Patrón Singleton
     * 
     * @return instance of protected variable
     */
    public static function getcon()
    {
        if (empty(self::$con)) {
            include APP_PATH . 'config.php';
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
