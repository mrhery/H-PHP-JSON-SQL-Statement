<?php
require_once(dirname(__DIR__) . "/controller/document_access.php");
require_once("core/init.php");
require_once("setup/config.php");

$stream = fopen("php://input", "r");
$string = stream_get_contents($stream);
$obj = json_decode($string, true);

require_once("controller/validation.php");
require_once("controller/request.php");
?>