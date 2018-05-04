<?php

namespace HJS;

class HJS_CONFIG{
	public static $config = array(
		array(
				#Request URL to HJS Server
				"url"			=> "https://another-website.com/HJS/",
				
				#Database Host
				"host"			=> "127.0.0.1",
				
				#Database Name
				"database"		=> "databaseNamea",
				
				#Database Username
				"username"		=> "databaseUsername",
				
				#Database Password
				"password"		=> "databasePassword",
				
				#Ex: Basic b64(username:password) | OAuth B64()
				"authorization"	=> "",
				
				#Request Key to Server HJS
				"key"			=> "27babd220d8cdbc38625add315ee2502bbe4cb4cdbe171340dcb979b25f3455a",
				
				#Optional header
				"header"		=> array()
			),
	);
}

?>
