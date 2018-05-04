<?php

namespace HJS;

class HJS_CONFIG{
	public static $config = array(
		array(
				#Request URL to HJS Server
				"url"			=> "https://workspace.intelhost.com.my/workspace/IntelhostCloud/HJS/",
				
				#Database Host
				"host"			=> "127.0.0.1",
				
				#Database Name
				"database"		=> "workspac_cloud",
				
				#Database Username
				"username"		=> "workspac_hery",
				
				#Database Password
				"password"		=> "hery@1234567890",
				
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