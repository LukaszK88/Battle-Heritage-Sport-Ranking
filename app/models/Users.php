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
        'quote',
        'about',
        'image',
        'total_points'
    ];
    
  
    public function bohurts(){

        return $this->hasOne('Battleheritage\models\Bohurts','user_id');
    }

    public function profights(){

        return $this->hasOne('Battleheritage\models\Profights','user_id');
    }

    public function swords(){

        return $this->hasOne('Battleheritage\models\Swords','user_id');
    }

    public function longswords(){

        return $this->hasOne('Battleheritage\models\Longswords','user_id');
    }

    public function polearms(){

        return $this->hasOne('Battleheritage\models\Polearms','user_id');
    }

    public function triathlons(){

        return $this->hasOne('Battleheritage\models\Triathlons','user_id');
    }

}