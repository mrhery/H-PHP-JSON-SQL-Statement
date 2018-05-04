<?php
require_once(dirname(__DIR__) . "/controller/document_access.php");

$data = array(
	"host"		=> $obj["host"],
	"database"	=> $obj["database"],
	"username"	=> $obj["username"],
	"password"	=> $obj["password"]
);

switch($obj["action"]){
	case "query":
		if(count($obj["data"]) > 0){
			$x = DB::conn($data)->query($obj["query"], $obj["data"]);
		}else{
			$x = DB::conn($data)->q($obj["query"]);
		}
		
		echo json_encode($x->results());
	break;
	
	case "update":
		$x = DB::conn($data)->update($obj["table"], $obj["where"], $obj["data"]);
		
		echo json_encode($x);
	break;
	
	case "insert":
		$x = DB::conn($data)->insert($obj["table"], $obj["data"]);
		
		echo json_encode($x);
	break;
	
	default:
		die("Action not available.");
	break;
}

?>