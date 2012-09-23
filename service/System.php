<?php
/**
 * This software is written for Boxee to integrate cool applications with boxee.
 * @author Petter Kjelkenes <kjelkenes@gmail.com>
 */
namespace com\boxee\service;

class System extends BoxeeNamespace{
	public function Shutdown(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function Suspend(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function Hibernate(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
	public function Reboot(){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}

	/**
	 * Get info labels about the system
	 *
	 * Example parameters:
	 * { "booleans": [ "system.canshutdown", "system.cansuspend" ] }
	 *
	 * Example result:
	 * [ { 'system.canshutdown' : true }, { 'system.cansuspend' : true }]
	 *
	 * @param array $labels <field name>s to return information for
	 * @return array of object field name boolean value of that field
	 */
	public function GetInfoLabels($labels){
		return $this->raw(__METHOD__, $this->getArgs(__FUNCTION__));
	}
}