<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 08/11/2016
 * Time: 14:28
 */

namespace Battleheritage\Validation\InputForms;

use Respect\Validation\Validator as v;

class AddImcfRecord{

    public static function rules(){

        return[
            
            'win' =>v::numeric(),
            'loss'=>v::numeric()
            
        ];
    }

}