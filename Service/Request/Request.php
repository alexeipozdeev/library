<?php

namespace Service\Request;


class Request
{
    Const PREFIX_COOKIE = 'library_';

    public function inGet($name, $default = false)
    {
        return isset($_GET[$name]) || isset($_POST[$name]) ? true : $default;
    }

    public function get($name, $default = null)
    {
        if(empty($name)) {
            throw new RequestException('Request variable name not specified');
        }

        if (isset($_GET[$name])) {
            return $_GET[$name];
        } elseif (isset($_POST[$name])) {
            return $_POST[$name];
        } else {
            return $default;
        }
    }

    public function getInt($name, $default = null)
    {
        $value = $this->get($name);

        return is_numeric($value) ? (int) $value : $default;
    }
}