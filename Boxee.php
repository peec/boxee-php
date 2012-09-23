<?php
/**
 * This software is written for Boxee to integrate cool applications with boxee.
 * @author Petter Kjelkenes <kjelkenes@gmail.com>
 */
namespace com\boxee;

use \com\boxee\service;

/**
 * A Boxee communication class that makes you able to control boxee.
 * 
 * @author peec
 *
 */
class Boxee{
	
	
	const API_VERSION = '2.0';
	
	private $socket;
	
	/**
	 * 
	 * @var com\boxee\service\Device
	 */
	private $device;
	
	
	
	/**
	 * Creates a new boxee device.
	 * @param string $host The hostname / IP address of boxee.
	 * @param string $deviceId The identifier of this remote. Something unique.
	 * @param int $port The port ( default: 9090 )
	 * @throws BoxeeConnectionException
	 */
	public function __construct($host, $deviceId = 'php_boxee_remote', $port = 9090){
		$this->device = new service\Device($this, $deviceId);
		$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		
		socket_set_option($this->socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 5, 'usec' => 0));
		
		if ($this->socket === false){
			throw new BoxeeConnectionException('socket_create() failed: reason: ' . socket_strerror(socket_last_error()));
		}
		
		$response = socket_connect($this->socket, $host, $port);
		if ($response === false){
			throw new BoxeeConnectionException('socket_connect() failed: reason: (' . $response . ') ' . socket_strerror(socket_last_error($this->socket)));
		}
		
	}
	
	
	/**
	 * Input commands
	 * @return com\boxee\service\Input
	 */
	public function input(){
		return new service\Input($this);
	}
	
	
	/**
	 * File commands
	 * @return com\boxee\service\Files
	 */
	public function files(){
		return new service\Files($this);
	}
	
	/**
	 * XBMC commands
	 * @return com\boxee\service\XBMC
	 */
	public function xbmc(){
		return new service\XBMC($this);
	}
	
	/**
	 * Returns whatever player that is currently running otherwise null.
	 * 
	 * @return com\boxee\service\Player
	 */
	public function player(){
		$data = $this->raw('Player.GetActivePlayers');
		$data = $data->result;
		if (!$data)return null;
		
		if ($data->audio){
			return new service\AudioPlayer($this);
		}elseif($data->picture){
			return new service\PicturePlayer($this);
		}elseif($data->video){
			return new service\VideoPlayer($this);
		}
		return null;
	}
	
	
	/**
	 * Device commands
	 * @return com\boxee\service\Device
	 */
	public function device(){
		return $this->device;
	}
	
	
	/**
	 * Use to send a raw command to JSON API
	 * See available commands at http://developer.boxee.tv/JSON_RPC.
	 * @param string $method The method, eg. Files.GetDirectory
	 * @param array $args Additional arguments.
	 */
	public function raw($method, $args = null){
		$this->device->checkConnection();
		return $this->send($method, $args);
	}
	
	/**
	 * Use to send a raw command to JSON API ( Note unconnected ).
	 * See available commands at http://developer.boxee.tv/JSON_RPC.
	 * @param string $method The method, eg. Files.GetDirectory
	 * @param array $args Additional arguments.
	 */
	public function unconnectedRaw($method, $args = null){
		return $this->send($method, $args);
	}
	
	
	
	
	/**
	 * Sends data to boxee.
	 * @param unknown_type $data
	 * @throws Exception
	 */
	protected function send($method, $args = null){
		$data = $this->buildJsonRequest($method, $args);
		
		
		
		
		// Write.
		if (!socket_write($this->socket, $data, strlen($data)))
			throw new BoxeeSocketSendException('socket_write() failed: reason: ('.$data.') ' . socket_strerror(socket_last_error($this->socket)));
		
		// Read. ( Can read a big length because boxee can give back huge amount of data ).
		
		$res  = @socket_read($this->socket, 13369345, PHP_BINARY_READ);
		
		if ($res){
			$res =  trim($res);
			
			if(!$res)throw new BoxeeSocketSendException("Empty result from reading socket.");
			
			$result = json_decode($res);
			
			if (isset($result->error))throw new BoxeeErrorException($result->error->message . 'Full request: ' . $data, $result->error->code);
			else return $result;
		}else
			throw new BoxeeSocketSendException('socket_read() failed: ('.$data.') ' . socket_strerror(socket_last_error($this->socket)));
	}
	
	public function buildJsonRequest($method, $args = null){
		list($s_class, $s_method) = explode('.', $method);
			
		// Create request.
		$obj = new \stdClass();
		$obj->jsonrpc = self::API_VERSION;
		$obj->id = 1;
		$obj->method = $method;
		
		if ($args != false && is_array($args) && count($args) > 0){
			$args = $this->parseArgs($s_class, $s_method, $args);
			
			$obj->params = (object)$args;
		}
		
		
		// Encode.
		$data = json_encode($obj);
		return $data;
	}
	
	public function parseArgs($class, $method, $args){
		// Open reflection to method.
		$cls = '\com\boxee\service\\'.$class;
		$ref = new \ReflectionMethod($cls, $method);
		
		$docStr = $ref->getDocComment();
		
		
		foreach($args as $k => $v){
			// Force type convertion based on docblock.
			preg_match('#@param.*?(int|float|string) \$'.$k.'#', $docStr, $matches);
			if (isset($matches[1])){
				switch($matches[1]){
					case 'int':
						$v = intval($v);
						break;
					case 'float':
						$v = floatval($v);
						break;
					case 'boolean':
						$v = $v ? true : false;
						break;
								
				}
			}
			$args[$k] = $v;
		}
		
		return $args;
	}
	
	/**
	 * Helper to generate a object of arguments.
	 * @param unknown_type $func_name
	 * @param unknown_type $values
	 * @return array Array of key -> value arguments.
	 */
	public function getArgs($func_name, $values=array(), $extras = array(), $object = null){
		if (count($values) == 0 && count($extras) == 0)return null;
		
		
		$realargs = array();
		if (count($values) > 0){
			$f = new \ReflectionMethod(($object === null ? $this : $object), $func_name);
			$params = $f->getParameters();
			$args = $values;
			$i = 0;
			foreach($params as $p){
				if (isset($args[$i]) && $args[$i] == service\BoxeeNamespace::ARG_OPTIONAL){
					// Just skip it. this argument is not set.
				}else{
					$realargs[$p->getName()] = isset($args[$i]) ? $args[$i] : $p->getDefaultValue();
				}
				$i++;
			}
		}
		
		// Add in extras.
		if (count($extras) > 0){
			$realargs = array_merge($realargs, $extras);
		}
		
		return $realargs;
	}
	
	
	/**
	 * Closes the open socket at php end of execution.
	 */
	public function __destruct(){
		socket_close($this->socket);
	}
	
}


class BoxeeConnectionException extends \Exception{

}
class BoxeeSocketSendException extends \Exception{

}
class BoxeeErrorException extends \Exception{

}
