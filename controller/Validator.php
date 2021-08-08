<?php

class Validator {

    protected static $old = [];
    protected static $errors = [];

    public static function make(array $data, array $rules ){

        foreach ($data as $fild => $value) {

            if (array_key_exists($fild,$rules)) {

                foreach ($rules[$fild] as $rule ) {

                    $args = null;

                    if (strpos($rule,':')) {
                        $newrule = explode(':', $rule);
                        $rule = $newrule[0];
                        $args = $newrule[1];
                    }

                    $result = self::$rule($fild, $value, $args);

                    if ($result['status']) {
                        self::$old[$fild] = $value;
                    } else {
                        self::$errors[$fild][] = $result['message'];
                        break;
                    }
                }
            }
        }

        return new static();
    }


    public static function fails () {

        return (count(static::$errors) > 0) ? true : false;
    }    

    public static function widthErrors () {

        $_SESSION['old'] = self::$old;
        $_SESSION['errors'] = self::$errors;

        return new static();
    }

    public static function required ($fild, $value, $args) {

        $data = ['status'=> true, 'message'=> ''];

        if (is_string($value) && mb_strlen(trim($value), 'UTF-8') > 0) {
            return $data;
        } else if (!is_null($value)) {
            return $data;
        }
        
        $data['status'] = false;
        $data['message'] = "The $fild fild is required!";

        return $data;

    }    
    
    public static function string ($fild, $value, $args) {

        $data = ['status'=> true, 'message'=> ''];

        if (is_string($value) && !is_numeric($value)) {
            return $data;
        }
        
        $data['status'] = false;
        $data['message'] = "In $fild you can use only string !";

        return $data;

    }      

    public static function number ($fild, $value, $args) {

        $data = ['status'=> true, 'message'=> ''];

        if (is_numeric($value)) {
            return $data;
        }
        
        $data['status'] = false;
        $data['message'] = "In $fild you can use only number !";

        return $data;

    }    
    
    public static function max ($fild, $value, $args) {

        $data = ['status'=> true, 'message'=> ''];

        if (mb_strlen(trim($value), 'UTF-8') < $args) {
            return $data;
        }
        
        $data['status'] = false;
        $data['message'] = "Max characters count is $args !";

        return $data;

    }

    public static function min ($fild, $value, $args) {

        $data = ['status'=> true, 'message'=> ''];

        if (mb_strlen(trim($value), 'UTF-8') > $args) {
            return $data;
        }
        
        $data['status'] = false;
        $data['message'] = "Min characters count is $args !";

        return $data;

    }

    public static function email($fild, $value, $args) {

        $data = ['status'=> true, 'message'=> ''];

        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return $data;
        }
        
        $data['status'] = false;
        $data['message'] = "Invalid email format !";

        return $data;

    }

    public static function confirm($fild, $value) {

        if(strcmp($fild, $value) != 0) {
            self::$errors['password'][] = "Password not confirmed !";
        }

        return new static();
    }

}