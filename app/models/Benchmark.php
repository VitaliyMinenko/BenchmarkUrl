<?php
/**
 * Created by PhpStorm.
 * User: Vitalii
 * Date: 2018-01-29
 * Time: 21:11
 */

namespace models;

use classes\Config;

/**
 * Class Benchmark - model for work with test entity.
 * @package models
 */
class Benchmark
{

    public $resultTest;

    /**
     * Make file with reports.
     */
    public function makeFile()
    {
        $result = $this->resultTest;
        $repport = '';
        foreach ($result as $key => $val) {
            $repport .= $key . ' ' . $val['url'] . ' ' . $val['seconds'] . ' seconds ' . $val['date'] . PHP_EOL;
        }
        $filename = Config::get('tmp_path') . Config::get('filename');
        $fp = fopen($filename, "w");
        fwrite($fp, $repport);
        return fclose($fp);
    }

    /**
     * Compare result of test
     * @param $result (array) - result of test.
     * @param $ourTime (float) - result of loading from our url.
     * @return string - state of result.
     */
    public function compere($result, $ourTime)
    {
        $state = '';
        $anUrl = [];
        foreach ($result as $key => $val) {
            $anUrl[$val['url']] = $val['seconds'];
        }
        $minVal = min($anUrl);
        $ourMin = $ourTime / 2;
        if ($ourTime > $minVal && $ourMin > $minVal) {
            $state = 'critical';
        } elseif ($ourTime > $minVal && $ourMin < $minVal) {
            $state = 'medium';
        } else {
            $state = 'normal';
        }
        return $state;
    }

    /**
     * Method which count time of loading.
     * @param $urls (array) all urls for test.
     * @return array result with time in seconds.
     */
    public function checkTime($urls)
    {
        $urlArr = [];
        foreach ($urls as $key => $val) {
            $param = explode('//', $val);
            if (count($param) == 1) {
                $val = 'http://' . $param[0];
                $urlArr[$key]['url'] = $param[0];
            } else {
                $urlArr[$key]['url'] = $param[1];
            }
            $start = microtime(true);
            $this->getContent($val);
            $result = round(microtime(true) - $start, 3);
            $urlArr[$key]['seconds'] = $result;
            $urlArr[$key]['date'] = date("Y-m-d H:i:s");
        }
        return $urlArr;
    }

    /**
     * Method for try load url.
     * @param $url (srt) - Url.
     * @param bool $post_paramtrs
     * @return mixed|string
     */
    public function getContent($url, $post_paramtrs = false)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        if ($post_paramtrs) {
            curl_setopt($c, CURLOPT_POST, TRUE);
            curl_setopt($c, CURLOPT_POSTFIELDS, "var1=bla&" . $post_paramtrs);
        }
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0");
        curl_setopt($c, CURLOPT_COOKIE, 'CookieName1=Value;');
        curl_setopt($c, CURLOPT_MAXREDIRS, 10);
        $follow_allowed = (ini_get('open_basedir') || ini_get('safe_mode')) ? false : true;
        if ($follow_allowed) {
            curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
        }
        curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 9);
        curl_setopt($c, CURLOPT_REFERER, $url);
        curl_setopt($c, CURLOPT_TIMEOUT, 60);
        curl_setopt($c, CURLOPT_AUTOREFERER, true);
        curl_setopt($c, CURLOPT_ENCODING, 'gzip,deflate');
        $data = curl_exec($c);
        $status = curl_getinfo($c);
        curl_close($c);
        preg_match('/(http(|s)):\/\/(.*?)\/(.*\/|)/si', $status['url'], $link);
        $data = preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/|\/)).*?)(\'|\")/si', '$1=$2' . $link[0] . '$3$4$5', $data);
        $data = preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/)).*?)(\'|\")/si', '$1=$2' . $link[1] . '://' . $link[3] . '$3$4$5', $data);
        return $status['http_code'];
    }

} 