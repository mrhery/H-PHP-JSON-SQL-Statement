<?php
require_once(dirname(__DIR__) . "/controller/document_access.php");

class Config{
	public static function get($paths = null){
		if($paths){
			$config = $GLOBALS["config"];
			$paths = explode("/", $paths);
			
			foreach($paths as $path){
				if(isset($config[$path])){
					$config = $config[$path];
				}
			}
			return $config;
		}
	}
}