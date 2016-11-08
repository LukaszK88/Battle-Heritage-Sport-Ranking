<?php

namespace Battleheritage\core;


use Battleheritage\core\config ;
use Battleheritage\core\Errors ;



class Controller{


    public function view($view, $data=[], $dontIncludeFile = false){
        if(!file_exists('../app/views/' .$view. '.php')){
            Errors::addError(Errors::errorMsg('1',array($view)));
        }elseif ($dontIncludeFile==true){
            require_once '../app/views/' . $view . '.php';
        }
        else {
            require_once config::get('default/header_file');
            require_once config::get('default/navtop');
            require_once config::get('default/navside');
            require_once '../app/views/' . $view . '.php';
            require_once config::get('default/footer_file');
            //require_once config::get('default/foot_file');
        }
    }
}