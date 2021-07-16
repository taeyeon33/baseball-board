<?php

namespace Eve\App;

class DB
{
    private static $con = null;

    public static function getDB()
    {
        $host = "localhost";
        $dbname = "baseballboard";
        $charset = "utf8mb4";
        $user = "root";
        $pass = "";
        $conStr = "mysql:host={$host}; dbname={$dbname}; charset={$charset}";
        if (self::$con == null) self::$con = new \PDO($conStr, $user, $pass);
        return self::$con;
    }

    public static function fetchAll($sql, $data = [])
    {
        $con = self::getDB();
        $q = $con->prepare($sql);
        $q->execute($data);
        return $q->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function fetch($sql, $data = [])
    {
        $con = self::getDB();
        $q = $con->prepare($sql);
        $q->execute($data);
        return $q->fetch(\PDO::FETCH_OBJ);
    }

    public static function execute($sql, $data = [])
    {
        $con = self::getDB();
        $q = $con->prepare($sql);
        return $q->execute($data);
    }
}