<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 08/11/2016
 * Time: 17:00
 */

namespace Battleheritage\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Profights extends Eloquent{

    protected $fillable=[
        'user_id',
        'win',
        'loss',
        'ko',
        'points'
    ];


    public function users(){

        return $this->belongsTo('Battleheritage\models\Users','user_id');

    }

}