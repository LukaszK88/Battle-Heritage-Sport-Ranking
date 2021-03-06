<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 07/11/2016
 * Time: 13:03
 */

namespace Battleheritage\models;

use Illuminate\Database\Eloquent\Model as Eloquent;


class Bohurts extends Eloquent{

    protected $fillable=[
        'user_id',
        'fights',
        'down',
        'suicide',
        'points'
    ];
    

    public function users(){

        return $this->belongsTo('Battleheritage\models\Users','user_id');
        
    }
    
}