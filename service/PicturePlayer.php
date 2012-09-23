<?php
/**
 * This software is written for Boxee to integrate cool applications with boxee.
 * @author Petter Kjelkenes <kjelkenes@gmail.com>
 */
namespace com\boxee\service;

class PicturePlayer extends BoxeeNamespace{
	public function PlayPause(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function Stop(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function SkipPrevious(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function SkipNext(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function MoveLeft(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function MoveRight(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function MoveDown(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function MoveUp(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function ZoomOut(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function ZoomIn(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	/**
	 * Zooms.
	 * @param int $number Zoom level to seek to, as a whole number between 1-10
	 */
	public function Zoom($number){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function Rotate(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
}

