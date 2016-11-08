<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 08/11/2016
 * Time: 14:28
 */

namespace Battleheritage\Validation\InputForms;

use Respect\Validation\Validator as v;

class AddBohurtRecord{

    public static function rules(){

        return[
            
            'fights' =>v::numeric(),
            'down'=>v::numeric(),
            'suicide'=>v::numeric()


        ];
    }

}