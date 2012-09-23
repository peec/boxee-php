<?php
/**
 * This software is written for Boxee to integrate cool applications with boxee.
 * @author Petter Kjelkenes <kjelkenes@gmail.com>
 */
namespace com\boxee\service;

class Input extends BoxeeNamespace{
	/**
	 * Returns the current navigation state, whether a mouse or keys navigation is enabled.
	 * RESULT
	 * keys-enabled     boolean    True if the navigation keys are enabled (currently always True)
	 * mouse-enabled    boolean    True if the mouse is  enabled
	 */
	public function NavigationState(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function Up(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function Down(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function Left(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function Right(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function Back(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function Home(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	/**
	 * 
	 * @param int $deltax
	 * @param int $deltay
	 */
	public function MouseMovement($deltax, $deltay){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__, func_get_args()));
	}
	public function MouseClick(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
}


