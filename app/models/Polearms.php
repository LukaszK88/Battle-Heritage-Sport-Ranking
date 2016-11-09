<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 08/11/2016
 * Time: 18:47
 */
namespace Battleheritage\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Polearms extends Eloquent{

    protected $fillable=[
        'user_id',
        'win',
        'loss',
        'points'
    ];


    public function users(){

        return $this->belongsTo('Battleheritage\models\Users','user_id');

    }

}