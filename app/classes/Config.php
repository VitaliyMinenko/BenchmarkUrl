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
        'title' => 'My Benchark',
        'tmp_path' =>'temp/',
        'filename' => 'log.txt',
        'mail_to' => 'exemple@mail.com',
        'mail_subject' => 'Result benchmark',
        'sms_username' =>'testUser',
        'sms_password' =>'aqwsxcde123',
        'sms_to' =>'4558886995',
        'sms_from' =>'4558889658',
    ];

    /**
     * Getter of config.
     */
    public static function get($configName)
    {
        return self::$config[$configName];
    }

}