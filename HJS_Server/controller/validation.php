<?php
require_once(dirname(__DIR__) . "/controller/document_access.php");

if($obj["key"] != $config["key"]){
	die(json_encode("Not allowed to access this HJS Server"));
}
?>