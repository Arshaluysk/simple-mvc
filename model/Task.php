<?php

class Task extends AbstractModel {

    protected static $table = 'task';


    public static function create(array $data) {

        $stmt = self::$db->prepare("INSERT INTO ".self::$table." (user_id, description) VALUES (?, ?)");
        $stmt->bind_param("sss", $data['user_id'], $data['description']);

        return $stmt->execute();
    }

    public static function updateStatus(int $status, int $id) {

        $stmt = self::$db->prepare("UPDATE ".static::$table." SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status,$id);
        return $stmt->execute();
    }
}
