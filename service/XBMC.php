<?php
/**
 * This software is written for Boxee to integrate cool applications with boxee.
 * @author Petter Kjelkenes <kjelkenes@gmail.com>
 */
namespace com\boxee\service;

class XBMC extends BoxeeNamespace{

	public function GetVolume(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__, func_get_args()));
	}

	/**
	 * 
	 * @param int $value
	 */
	public function SetVolume($value){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__, func_get_args()));
	}

	public function ToggleMute(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__, func_get_args()));
	}

	public function Play($file, $contenttype = BoxeeNamespace::ARG_OPTIONAL){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__, func_get_args()));
	}

	/**
	 * Starts slideshow.
	 * @param unknown_type $directory
	 * @param unknown_type $random
	 * @param unknown_type $recursive
	 */
	public function StartSlideshow($directory, $random = BoxeeNamespace::ARG_OPTIONAL, $recursive = BoxeeNamespace::ARG_OPTIONAL){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__, func_get_args()));
	}

	public function Quit(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__, func_get_args()));
	}




}
