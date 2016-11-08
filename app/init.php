<?php
use Battleheritage\core\App ;

use Illuminate\Database\Capsule\Manager as Capsule;


session_start();
require_once 'config/init.php';


require  __DIR__.'/../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'Validation'  => 'battleheritage',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();


$app = new App();

