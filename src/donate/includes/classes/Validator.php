<?php

class Validator {

    private static function _checkUUIDv4($uuid) {

        if (!is_string($uuid) || (preg_match('/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}$/i', $uuid) !== 1)) {
            return false;
        }
    
        return true;
    }

    private static function _checkType($value, $type) {

        switch($type) {
            case 'number':
                return (filter_var($value, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) !== false) ? true : 'Invalid number (must be at least 1)';
            case 'email':
                return (filter_var($value, FILTER_VALIDATE_EMAIL) !== false) ? true : 'Invalid email address';
            case 'uuid':
                return self::_checkUUIDv4($value) ? true : 'Invalid uuidv4.'; 
            default:
                return true;
        }
    }

    public static function checkParams($constraints) {

        $errors = new stdClass;

        foreach ($constraints as $name => $type) {
            $value = isset($_REQUEST[$name]) ? $_REQUEST[$name] : null;

            if (self::_checkType($value, $type) === true)
                continue;

            $errors->$name = self::_checkType($value, $type);
        }

        return $errors;
    }
}
