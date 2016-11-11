<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 08/11/2016
 * Time: 10:05
 */
namespace Battleheritage\Validation\InputForms;

use Respect\Validation\Validator as v;

class AddUser{

    public static function rules(){

        return[
            'name'=>v::alpha('- '),
            'rank'=>v::alpha(),
            'age' =>v::numeric(),
            'region'=>v::alpha(' '),
            'weight'=>v::numeric(),
            'quote'=>v::alpha(',. '),
            'about'=>v::alpha(',. '),

        ];
    }

}