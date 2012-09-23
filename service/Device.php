<?php
namespace com\boxee\service;

class Device extends BoxeeNamespace{
	
	const ICON_OTHER = 'other';
	const ICON_TABLET = 'tablet';
	const ICON_PHONE = 'phone';
	const ICON_REMOTE = 'remote';
	
	private $deviceId;
	private $connected = false;
	
	public function __construct(\com\boxee\Boxee $boxee, $deviceId){
		parent::__construct($boxee);
		$this->deviceId = $deviceId;
	}
	
	
	/**
	 * This is step 1, boxee needs to know of a pairing.
	 * @param string $applicationid Application Identity.
	 * @param string $label The label of this application.
	 * @param string $icon URL (external) to an image ( icon ).
	 * @param string $type One of the ICON_ constants in this class.
	 */
	public function PairChallenge($label, $applicationid = 'PHP_APPLICATION', $icon = '', $type = self::ICON_OTHER){
		return $this->unconnectedRaw(__METHOD__, $this->getArgs(__FUNCTION__, func_get_args(), array('deviceid' => $this->deviceId)));
	}
	
	
	public function PairResponse($code){
		return $this->unconnectedRaw(__METHOD__, $this->getArgs(__FUNCTION__, func_get_args(), array('deviceid' => $this->deviceId)));
	}
	
	
	public function UnPair(){
		return $this->unconnectedRaw(__METHOD__, $this->getArgs(__FUNCTION__, func_get_args(), array('deviceid' => $this->deviceId)));
	}
	
	public function Connect(){
		return $this->unconnectedRaw(__METHOD__, $this->getArgs(__FUNCTION__, func_get_args(), array('deviceid' => $this->deviceId)));
	}
	
	
	public function checkConnection(){
		if (!$this->connected){
			$this->Connect();
		}
		$this->connected = true;
		
	}
	
}