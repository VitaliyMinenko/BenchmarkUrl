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
        $route = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $routing = [
            //  Routs for api.
            '/Api/setState/' => [
                'controller' => 'Api',
                'action' => 'setState',
            ],
            '/Api/getNext/' => [
                'controller' => 'Api',
                'action' => 'getNext',
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