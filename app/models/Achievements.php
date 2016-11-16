<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 16/11/2016
 * Time: 19:58
 */
namespace Battleheritage\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Achievements extends Eloquent{

    protected $fillable=[
        'user_id',
        'location',
        'date',
        'place',
        'competitionName'
    ];


    public function users(){

        return $this->belongsTo('Battleheritage\models\Users','user_id');

    }

}