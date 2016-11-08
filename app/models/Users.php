<?php

namespace Battleheritage\models;

use Illuminate\Database\Capsule\Manager as Capsule;

use Illuminate\Database\Eloquent\Model;
use Battleheritage\models\Bohurts;


class Users extends Model{

  
    public function bohurts(){

        return $this->hasOne('Bohurts');
    }

}