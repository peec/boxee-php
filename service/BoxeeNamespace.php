<?php
/**
 * This software is written for Boxee to integrate cool applications with boxee.
 * @author Petter Kjelkenes <kjelkenes@gmail.com>
 */
namespace com\boxee\service;

abstract class BoxeeNamespace{

	const ARG_OPTIONAL = 'ARGUMENT_IS_OPTIONAL';

	/**
	 *
	 * @var com\boxee\Boxee
	 */
	private $b;

	public function __construct(\com\boxee\Boxee $boxee){
		return $this->b = $boxee;
	}

	public function raw($name, $args = null){
		$bit = explode('\\',str_replace('::','.',$name));
		return $this->b->raw(end($bit), $args);
	}
	public function unconnectedRaw($name, $args = null){
		$bit = explode('\\',str_replace('::','.',$name));
		return $this->b->unconnectedRaw(end($bit), $args);
	}

	public function getArgs($func_name, $values=array(), $extras = array()){
		return $this->b->getArgs($func_name, $values, $extras, $this);
	}
}