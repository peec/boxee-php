<?php
/**
 * This software is written for Boxee to integrate cool applications with boxee.
 * @author Petter Kjelkenes <kjelkenes@gmail.com>
 */
namespace com\boxee\service;

class Files extends BoxeeNamespace{

	const T_VIDEO = 'video';
	const T_MUSIC = 'music';
	const T_PICTURES = 'pictures';
	const T_FILES = 'files';


	/**
	 * Gets a list of shares.
	 * @param string $media One of the T_ constants in com\boxee\Files class.
	 */
	public function GetSources($media){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__, func_get_args()));

	}

	/**
	 * Gets a list of directories / files on boxee.
	 * @param string $media One of the T_ constants in com\boxee\Files class.
	 * @param string $directory The share path ( can get from GetSources ).
	 */
	public function GetDirectory($media, $directory){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__, func_get_args()));
	}

}



