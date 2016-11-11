<?php

namespace Battleheritage\models;

use Illuminate\Database\Capsule\Manager as Capsule;

use Illuminate\Database\Eloquent\Model;
use Battleheritage\models\Bohurts;

use Battleheritage\core\Session ;


class Users extends Model{


    protected $fillable=[
        'name',
        'username',
        'temp_password',
        'salt',
        'password',
        'rank',
        'age',
        'weight',
        'region',
        'quote',
        'about',
        'image',
        'coa',
        'total_points'
    ];

    public function login($username=null,$password=null,$remember=false){

        if(!$username and !$password and $this->exists()){
            Session::put($this->_sessionName,$this->data()->id);
        }else {
            $user = $this->find($username);

            if ($user) {
                if (($this->data()->password === Hash::make($password, $this->data()->salt)) or ($this->data()->temp_password === $password)) {
                    Session::put($this->_sessionName, $this->data()->id);
                    if($this->hasPermission('admin')){
                        Session::put('admin','administrator');
                    }
                    if ($remember) {
                        $hash = Hash::unique();
                        $hashCheck = $this->_db->get('user_sessions', array('user_id', '=', $this->data()->id));

                        if (!$hashCheck->count()) {
                            $this->_db->insert('user_sessions', array(
                                'user_id' => $this->data()->id,
                                'hash' => $hash

                            ));
                        } else {
                            $hash = $hashCheck->first()->hash;
                        }
                        Cookie::put($this->_cookieName, $hash, config::get('remember/cookie_expiry'));
                    }
                    return true;
                }
            }
        }
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