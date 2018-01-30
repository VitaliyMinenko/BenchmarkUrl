<?php
/**
 * Created by PhpStorm.
 * User: Vitalii
 * Date: 2018-01-29
 * Time: 21:53
 */

namespace classes;

/**
 * Class Sms - for sms sending.
 * @package classes
 */
class Sms
{

    public $username;
    public $password;
    public $to;
    public $from;
    public $message;

    public function __construct($message)
    {
        $this->username = Config::get('sms_username');
        $this->password = Config::get('sms_password');;
        $this->to = Config::get('sms_to');
        $this->from = Config::get('sms_from');
        $this->message = $message;
    }

    /**
     * Base method for sending.
     * @return array
     */
    public function send()
    {
        $params = [
            'username' => $this->username,
            'password' => $this->password,
            'to' => $this->to,
            'from' => $this->from,
            'message' => $this->message,
        ];
        $url = 'https://api.smsapi.pl/sms.do';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $params);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($c);
        $http_status = curl_getinfo($c, CURLINFO_HTTP_CODE);
        curl_close($c);
        return [$content, $http_status];
    }

} 