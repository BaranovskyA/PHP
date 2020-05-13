<?php   

function GET($key, $default = null) {
        return $_GET[$key] ?? $default;
    }

function POST($key, $default = null) {
    return $_POST[$key] ?? $default;
}

function SESSION($key,$value = null, $default) {
    if($value)
        $_SESSION[$key] = $value;
    return $_SESSION[$key] ?? $default;
}