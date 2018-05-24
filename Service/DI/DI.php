<?php

namespace Service\DI;

use Service\Db\Db;
use Service\Request\Request;


/**
 * Class DI
 *
 * @method static Db            Db
 * @method static Request       Request
 *
 */

class DI
{
    private static $service;

    /**
     * Наполнение контейнера сервисами
     */
    private static function init()
    {
        self::$service = [
            'Db' => [
                'object' => '',
                'class' => 'Core\\Services\\Db\\Db',
            ],
            'Request' => [
                'object' => '',
                'class' => 'Core\\Services\\Request\\Request',
            ],
        ];
    }

    /**
     * Получаем сервис из контейнера
     *
     * @param string $name
     * @return DI
     * @throws DIException
     */
    private static function get($name)
    {
        self::init();

        if (!self::$service) {
            throw new DIException('Non install services');
        }

        if(!isset(self::$service[$name])) {
            throw new DIException('Service "'. $name . '" not install');
        }

        if (empty(self::$service[$name]['object'])) {
            $className = self::$service[$name]['class'];
            self::$service[$name]['object'] = new $className();
        }

        return self::$service[$name]['object'];
    }

    /**
     * Вызов сервиса по имени.
     *
     * @param string $name
     * @param mixed  $arguments
     *
     * @return object
     */
    public static function __callStatic($name, $arguments)
    {
        return self::get($name);
    }
}