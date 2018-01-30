<?php
/**
 * Created by PhpStorm.
 * User: Vitalii
 * Date: 2018-01-20
 * Time: 19:01
 */

namespace controllers;

/**
 * Controller - Base controoler for all controllers.
 *
 * @package controllers
 */
class Controller
{

	/**
	 * Method for rendering view.
	 *
	 * @param      $tamplate
	 * @param null $args
	 */
	public function render($tamplate, $args = null)
	{
		require_once('view/main.php');
	}

    /**
     * Method for getting params from url.
     * @param $param
     * @return string
     */
	public function get($param)
	{
		$param = isset($param)
			? $param
			: '';
		$str = $param;
		$str = trim($str);
		$str = stripslashes($str);
		$str = htmlspecialchars($str);

		return $str;
	}


}