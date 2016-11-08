<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 19/09/2016
 * Time: 13:37
 */
namespace Battleheritage\core;

use Battleheritage\core\config ;

class Url{
    
    public static function path(){
        return config::get('path/URL');
    }
    public static function main(){
        return config::get('path/main');
    }
}