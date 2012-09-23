<?php
/**
 * This software is written for Boxee to integrate cool applications with boxee.
 * @author Petter Kjelkenes <kjelkenes@gmail.com>
 */
namespace com\boxee\service;

abstract class Player extends BoxeeNamespace{

	public function State(){
		return $this->raw($this->cls(__FUNCTION__), $this->getArgs(__FUNCTION__, func_get_args()));
	}
	

	public function PlayPause(){
		return $this->raw($this->cls(__FUNCTION__), $this->getArgs(__FUNCTION__, func_get_args()));
	}
	public function Stop(){
		return $this->raw($this->cls(__FUNCTION__), $this->getArgs(__FUNCTION__, func_get_args()));
	}
	public function SkipPrevious(){
		return $this->raw($this->cls(__FUNCTION__), $this->getArgs(__FUNCTION__, func_get_args()));
	}
	public function SkipNext(){
		return $this->raw($this->cls(__FUNCTION__), $this->getArgs(__FUNCTION__, func_get_args()));
	}
	public function BigSkipBackward(){
		return $this->raw($this->cls(__FUNCTION__), $this->getArgs(__FUNCTION__, func_get_args()));
	}
	public function BigSkipForward(){
		return $this->raw($this->cls(__FUNCTION__), $this->getArgs(__FUNCTION__, func_get_args()));
	}
	public function SmallSkipBackward(){
		return $this->raw($this->cls(__FUNCTION__), $this->getArgs(__FUNCTION__, func_get_args()));
	}
	public function SmallSkipForward(){
		return $this->raw($this->cls(__FUNCTION__), $this->getArgs(__FUNCTION__, func_get_args()));
	}
	public function GetTime(){
		return $this->raw($this->cls(__FUNCTION__), $this->getArgs(__FUNCTION__, func_get_args()));
	}
	public function GetPercentage(){
		return $this->raw($this->cls(__FUNCTION__), $this->getArgs(__FUNCTION__, func_get_args()));
	}
	/**
	 * 
	 * @param int $value
	 */
	public function SeekTime($value){
		return $this->raw($this->cls(__FUNCTION__), $this->getArgs(__FUNCTION__, func_get_args()));
	}
	
	/**
	 *
	 * @param int $value
	 */
	public function SeekPercentage($value){
		return $this->raw($this->cls(__FUNCTION__), $this->getArgs(__FUNCTION__, func_get_args()));
	}

	
	public function isPaused(){
		return $this->State()->result->paused;
	}
	public function isPlaying(){
		return $this->State()->result->playing;
	}
	

	/**
	 * Helper to get method of superclass.
	 * @param unknown_type $func
	 * @return string
	 */
	private function cls($func){
		return get_class($this).'::'.$func;
	}

}

