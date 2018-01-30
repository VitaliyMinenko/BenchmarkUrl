<?php
/**
 * Created by PhpStorm.
 * User: Vitalii
 * Date: 2018-01-20
 * Time: 14:33
 */

namespace classes;

/**
 * Class Router - Set all available routs.
 *
 * @package classes
 */
class Router
{

    /**
     * Base method fpr route.
     */
    public function start()
    {
        require_once('app/controllers/BenchmarkController.php');
        $route = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $routing = [
            //  Routs for application.
            '/' => [
                'controller' => 'Benchmark',
                'action' => 'index',
            ],
            '/benchmark/test' => [
                'controller' => 'Benchmark',
                'action' => 'test',
            ],
            '/benchmark/download' => [
                'controller' => 'Benchmark',
                'action' => 'download',
            ],
        ];
        if (isset($routing[$route])) {
            $controller = '\\controllers\\' . $routing[$route]['controller'] . 'Controller';
            $objectController = new $controller;
            $action = $routing[$route]['action'] . 'Action';
            $objectController->$action();
        } else {
            echo 'Nothing to found';
        }
    }

} 