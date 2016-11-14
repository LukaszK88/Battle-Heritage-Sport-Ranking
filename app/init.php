<?php
use Battleheritage\core\App ;
use Battleheritage\core\config ;

use Illuminate\Database\Capsule\Manager as Capsule;


session_start();
require_once 'config/init.php';


require  __DIR__.'/../vendor/autoload.php';





$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => getenv('DB_HOST'),
    'Validation'  => 'battleheritage',
    'database'  => getenv('DB_DB'),
    'username'  => getenv('DB_USERNAME'),
    'password'  => getenv('DB_PASSWORD'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();


$app = new App();

