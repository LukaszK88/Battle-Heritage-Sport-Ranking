<?php
session_start();
require '../vendor/autoload.php';

require 'database/Database.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();


spl_autoload_register(function($class){
    require_once 'core/' . $class . '.php';
});


require_once 'config/init.php';

