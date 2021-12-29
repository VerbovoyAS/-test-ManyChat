<?php
class DB {
    private static $_db = null;

    public static function getInstanse(){

        $db_pass = 'tiger';
        $db_user = 'root';
        $db_name = 'many_chat';
        $db_host = 'database:3306';

        if(self::$_db == null)
            self::$_db = new PDO('mysql:host='.$db_host.';dbname='.$db_name.';charset=UTF8', $db_user, $db_pass);

        return self::$_db;
    }

    private function __construct(){}
    private function __clone(){}
}