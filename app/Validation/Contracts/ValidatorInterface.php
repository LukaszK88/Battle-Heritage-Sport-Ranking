<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 08/11/2016
 * Time: 07:41
 */

namespace Battleheritage\Validation\Contracts ;

interface ValidatorInterface{

    public function validate($post=[],$rules=[]);

    public function fails();

}