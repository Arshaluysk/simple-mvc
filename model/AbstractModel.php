<?php

abstract class AbstractModel {

    protected static $db = null;
    protected static $query = null;
    protected static $table = null;

    function __construct() {

        self::$db = new mysqli('localhost', 'root', '', 'mvc');
    }

    public static function select($filables){

        self::$query = "SELECT $filables FROM ".static::$table;
        return new static();
    }

    public static function join($table,$from, $to){

        self::$query .= " INNER JOIN $table ON $table.`$from` = ".static::$table.".`$to`";
        return new static();
    }

    public static function sort($colum, int $value){

        $colum = self::$db->real_escape_string($colum);    
        $value = ($value == 0) ? 'asc' : 'desc';

        self::$query .= " ORDER BY `$colum` $value";
        return new static();
    }

    public static function limit(int $from = 0, int $to = 3) {

        self::$query .= " LIMIT $from , $to";
        return new static();
    }

    public static function where($colum,$action,$value) {

        self::$query .= " WHERE ".static::$table.".`$colum`$action '$value'";
        return new static();
    }

    public static function whereAnd($colum,$action,$value) {

        self::$query .= " and WHERE ".static::$table."`$colum`$action '$value'";
        return new static();
    }

    public static function count() {

        self::$query = "SELECT COUNT(id) as count FROM ".static::$table;
        return new static();
    }

    public static function get() {
        return static::$db->query(static::$query)->fetch_all(MYSQLI_ASSOC);
    }    
    
    public static function first() {

        return static::$db->query(static::$query)->fetch_object();
    }
}