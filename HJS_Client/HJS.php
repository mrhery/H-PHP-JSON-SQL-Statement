<?php

namespace HJS;

class HJS{
	private static $_instance = null;
	private $url = array();
	
	public function __construct($url = ""){
		if(!empty($url)){
			if(is_array($url)){
				if(isset($url["url"], $url["key"])){
					if(!isset($url["database"], $url["username"], $url["password"], $url["host"])){
						$url["database"] = "";
						$url["username"] = "";
						$url["password"] = "";
						$url["host"] = "";
					}
					
					$this->url = $url;
				}else{
					die("Data format inserted not correct.");
				}
			}else{
				if(isset(HJS_CONFIG::$config[$url])){
					$this->url = HJS_CONFIG::$config[$url];
				}else{
					die("HJS fail to find url to request.");
				}
			}
		}else{
			if(count(HJS_CONFIG::$config) > 0){
				$this->url = HJS_CONFIG::$config[0];
			}else{
				die("HJS fail to find url to request.");
			}
		}
	}
	
	public static function req($url = ""){
		return new HJS($url);
	}
	
	public function query($query = "", $data = array()){
		$param = array(
			"action"	=> "query",
			"query"		=> $query,
			"data"		=> $data,
			"key"		=> $this->url["key"],
			"host"		=> $this->url["host"],
			"database"	=> $this->url["database"],
			"username"	=> $this->url["username"],
			"password"	=> $this->url["password"]
		);
		
		return $this->send(json_encode($param));
	}
	
	public function update($table = "", $where = "", $data = array()){
		$param = array(
			"action"	=> "update",
			"table"		=> $table,
			"where"		=> $where,
			"data"		=> $data,
			"key"		=> $this->url["key"],
			"host"		=> $this->url["host"],
			"database"	=> $this->url["database"],
			"username"	=> $this->url["username"],
			"password"	=> $this->url["password"]
		);
		
		return $this->send(json_encode($param));
	}
	
	public function insert($table = "", $data = array()){
		$param = array(
			"action"	=> "insert",
			"table"		=> $table,
			"data"		=> $data,
			"key"		=> $this->url["key"],
			"host"		=> $this->url["host"],
			"database"	=> $this->url["database"],
			"username"	=> $this->url["username"],
			"password"	=> $this->url["password"]
		);
		
		return $this->send(json_encode($param));
	}
	
	public function send($json){
		$ch = curl_init($this->url["url"]);
		$header = array();
		
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		
		if(isset($this->url["authorization"])){
			if(!empty($this->url["authorization"])){
				array_push($header, "Authorization " . $this->url["authorization"]);
			}
		}
		
		if(isset($this->url["header"])){
			for($i = 0; $i < count($this->url["header"]); $i++){
				array_push($header, $this->url["header"][$i]);
			}
		}
		
		if(count($header) > 0){
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		}
		
		$response = curl_exec($ch);
		
		return json_decode($response);
	}
}

?>
