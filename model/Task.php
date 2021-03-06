<?php

class Task extends AbstractModel {

    protected static $table = 'task';


    public static function create(array $data) {

        $stmt = self::$db->prepare("INSERT INTO ".self::$table." (name, email, description) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $data['name'], $data['email'], $data['description']);

        return $stmt->execute();
    }

    public static function updateStatus(int $status, int $id) {

        $stmt = self::$db->prepare("UPDATE ".static::$table." SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status,$id);
        return $stmt->execute();
    }

    public static function update(array $data, int $id) {

        $stmt = self::$db->prepare("UPDATE ".static::$table." SET status = ?, description = ? WHERE id = ?");
        $stmt->bind_param("sss", $data['status'], $data['description'], $id);
        return $stmt->execute();
    }
}
