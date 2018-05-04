<?php
require_once(dirname(__DIR__) . "/controller/document_access.php");

//Default database information. HJS will choose below database information 
//if there is not database information were set from client HJS
//

$GLOBALS["config"] = array(
	"mysql" => array(
		"host" => "",
		"username" => "",
		"password" => "",
		"db" => ""
	)
);

?>