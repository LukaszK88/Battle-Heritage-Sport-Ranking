<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 08/11/2016
 * Time: 10:05
 */
namespace Battleheritage\Validation\InputForms;

use Respect\Validation\Validator as v;

class RegisterUser{

    public static function rules(){

        return[
            'email'=>v::email(),
        ];
    }

}