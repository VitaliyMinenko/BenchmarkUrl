<?php
/**
 * Created by PhpStorm.
 * User: Vitalii
 * Date: 23.01.2018
 * Time: 10:02
 */

namespace classes;

/**
 * Class Config - Get config.
 *
 * @package classes
 */
class Config
{
    /**
     * Init config array.
     *
     * @var array
     */
    public static $config = [
        'title' => 'Game app',
        'tmp_path' =>'temp/',
    ];

    /**
     * Getter of config.
     */
    public static function get($configName)
    {
        return self::$config[$configName];
    }

}