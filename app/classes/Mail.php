<?php
/**
 * Created by PhpStorm.
 * User: Vitalii
 * Date: 2018-01-29
 * Time: 21:23
 */

namespace classes;

/**
 * Class Mail - for email send.
 * @package classes
 */
class Mail {
    public $to;
    public $subject;
    public $message;
    public $headers;
    public function __construct($to,$subject,$message){
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Send mail method.
     * @return bool
     */
    public function sendMail(){
        return mail($this->to, $this->subject, $this->message,null);
    }
}


