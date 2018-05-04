<?php
require_once(dirname(__DIR__) . "/controller/document_access.php");

require_once("core/config.php");

spl_autoload_register(function($className)
{
    $namespace = str_replace("\\", "/", __NAMESPACE__);
    $className = str_replace("\\", "/", $className);
    $class = "classes/" . (empty($namespace) ? "" : $namespace . "/") . "{$className}.php";
    include_once($class);
});

?>
