<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 08/11/2016
 * Time: 07:44
 */

namespace Battleheritage\Validation;

use Battleheritage\core\Session;
use Battleheritage\Validation\Contracts\ValidatorInterface;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator implements ValidatorInterface{

    protected $errors = [];

    public function validate($post=[], $rules = []){

        foreach ($rules as $field => $rule){
            try{

                $rule->setName(ucfirst($field))->assert($post[$field]);

            }catch (NestedValidationException $e){
                $this->errors[$field] = $e->getMessages();
            }

            Session::put('errors',$this->errors);


        }

        return $this;
    }
    
    public static function validationError($error){

        if(isset($_SESSION['errors'][$error]) and (!empty($_SESSION['errors'][$error]))){
            echo $_SESSION['errors'][$error][0];
            unset( $_SESSION['errors'][$error][0]);
        }
    }

    public static function validationErrorExists($error){

        if(!empty($_SESSION['errors'][$error])){
           
            return true;
        }
        
        return false ;
    }

    public function fails(){

        return !empty($this->errors);
    }
}