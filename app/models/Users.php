<?php

namespace Battleheritage\models;

use Illuminate\Database\Capsule\Manager as Capsule;

use Illuminate\Database\Eloquent\Model;
use Battleheritage\models\Bohurts;


class Users extends Model{


    protected $fillable=[
        'name',
        'rank',
        'age',
        'weight',
        'region',
        'total_points'
    ];
    
    public function points(){
        return $this->hasMany('points','user_id');
    }

  
    public function bohurts(){

        return $this->hasOne('Battleheritage\models\Bohurts','user_id');
    }

    public function profights(){

        return $this->hasOne('Battleheritage\models\Profights','user_id');
    }

    public function swords(){

        return $this->hasOne('Battleheritage\models\Swords','user_id');
    }

}