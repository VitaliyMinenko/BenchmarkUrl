<?php
/**
 * Created by PhpStorm.
 * User: Vitalii
 * Date: 2018-01-29
 * Time: 23:09
 */
require('app/models/Benchmark.php');

/**
 * Class BenchmarkTest - Test basic logic of the app.
 */
class BenchmarkTest extends PHPUnit_Framework_TestCase
{

    public $obj;
    public $urlsArr;
    public $our;
    public $arrTimes;

    public function __construct()
    {
        $this->obj = new models\Benchmark;
        $this->urlsArr = [
            1 => 'exampl.pl',
            2 => 'info.pl',
            3 => 'test.pl',

        ];
        $this->our = '0.236';
        $this->arrTimes = [
            1 => ['url' => 'exampl.pl', 'seconds' => 0.548],
            2 => ['url' => 'info.pl', 'seconds' => 0.256],
            3 => ['url' => 'test.pl', 'seconds' => 0.789],

        ];
    }

    /**
     * Compare test with test params.
     */
    public function testCompare()
    {
        $benchmark = $this->obj;
        $our = $this->our;
        $arr = $this->arrTimes;
        $benchmark->compere($arr, $our);
        $this->assertEquals('normal', $benchmark->compere($arr, $our));
    }

    /**
     * Test for timecheker and return min one insatnce of array.
     */
    public function testCheckTime()
    {
        $benchmark = $this->obj;
        $arr = $this->urlsArr;
        $this->assertArrayHasKey(1, $benchmark->checkTime($arr));
    }

    /**
     * Test get connection expect 200
     */
    public function testGetContent()
    {
        $benchmark = $this->obj;
        $this->assertEquals(200,$benchmark->getContent('http:/www.lol.pl'));
    }
}