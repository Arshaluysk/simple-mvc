<?php

class User extends AbstractModel {

    protected static $table = 'user';


    public static function create(array $data) {

    	$stmt = self::$db->prepare("INSERT INTO ".self::$table." (name, email, password) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $data['name'], $data['email'], $data['password']);

		return $stmt->execute();
    }


}
