<?php
/**
 * This software is written for Boxee to integrate cool applications with boxee.
 * @author Petter Kjelkenes <kjelkenes@gmail.com>
 */


function boxee_autoloader($className){
	$ns = 'com\boxee';
	$nsLen = strlen($ns);
	if (substr($className, 0, $nsLen) == $ns){
		$len = strlen($className);
		$path = substr(str_replace('\\', DIRECTORY_SEPARATOR, $className), -($len-$nsLen));
		require dirname(__FILE__). DIRECTORY_SEPARATOR . $path . '.php';
	}
}

spl_autoload_register('boxee_autoloader');
