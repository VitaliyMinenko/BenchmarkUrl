<?php
/**
 * Created by PhpStorm.
 * User: Vitalii
 * Date: 2018-01-28
 * Time: 23:28
 */

namespace controllers;

use classes\Config;
use models\Benchmark;
use classes\Mail;
use classes\Sms;

/**
 * BenchmarkController - Controller for view main page.
 *
 * @package controllers
 */
class BenchmarkController extends Controller
{

    /**
     * Action for main page.
     */
    public function indexAction()
    {

        $this->render('benchmark');
    }

    /**
     * Action for make benchmark test.
     */
    public function testAction()
    {
        $ourUrl = isset($_POST['ourUrl']) ? $this->get($_POST['ourUrl']) : null;
        $anotherUrls = isset($_POST['anotherUrls']) ? $this->get($_POST['anotherUrls']) : null;
        $allUrls = [];
        if ($ourUrl != null) {
            $allUrls[0] = $ourUrl;
        }
        if ($anotherUrls != null) {
            $allUrls = array_merge($allUrls, explode(' ', $anotherUrls));
        }
        $benchmark = new Benchmark();
        $result = $benchmark->checkTime($allUrls);
        $benchmark->resultTest = $result;
        $ourUrl = $result[0];
        unset($result[0]);
        $state = $benchmark->compere($result, $ourUrl['seconds']);
        if ($state == 'critical') {
            $this->sendSms($benchmark->resultTest);
            $this->sendMail($benchmark->resultTest);
        } elseif ($state == 'medium') {
            $this->sendMail($benchmark->resultTest);
        }
        $benchmark->makeFile();
        $resultTest = $benchmark->resultTest;
        $resultTest[0]['url'] .= '  (Our)';
        $this->render('result', $resultTest);
    }


    /**
     * Download log with test info.
     */
    public function downloadAction()
    {

        $filename = Config::get('tmp_path') . Config::get('filename');
        set_time_limit(0);
        header('HTTP/1.0 200 OK');
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        header('Content-Length: ' . (filesize($filename)));
        header('Content-Type: application/x-rar-compressed');
        @readfile($filename);
    }

    /**
     * Send sms if critical statement.
     * @param $result
     */
    private function sendSms($result)
    {
        $messege = 'Critical download of page'.$result[0]['url'].'load time is '.$result[0]['seconds'].' seconds';
        $sms = new Sms($messege);
       $sms->send();

    }

    /**
     * Send mail dor medium statement.
     * @param $result
     */
    private function sendMail($result)
    {
        $repport = '';
        foreach ($result as $key => $val) {
            $repport .= $key . ' ' . $val['url'] . ' ' . $val['seconds'] . ' seconds ' . $val['date'] . PHP_EOL;
        }
        $mail = new Mail(Config::get('mail_to'), Config::get('mail_subject'), $repport);
        $mail->sendMail();
    }

} 