<?php

namespace Battleheritage\models;

use Illuminate\Database\Capsule\Manager as DB;

use Illuminate\Database\Eloquent\Model;
use Battleheritage\models\Bohurts;

use Battleheritage\core\Session ;
use Battleheritage\core\config ;
use Battleheritage\core\Hash ;
use Battleheritage\core\Cookie ;

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

    protected
        $_data,
        $_sessionName,
        $_cookieName,
        $_isLoggedIn;

    public function __construct($user = null){
        parent::__construct();


        $this->_sessionName = config::get('session/session_name');
        $this->_cookieName = config::get('remember/cookie_name');

        if(!$user){
            if(Session::exists($this->_sessionName)){
                $user = Session::get($this->_sessionName);

                if($this->findUser($user)){
                    $this->_isLoggedIn = true;
                }else{
                    //log out
                }
            }
        }else{
            $this->findUser($user);
        }


    }


    public function findUser($user=null){
        if($user){
            $field=(is_numeric($user)) ? 'id':'username';

            $data = DB::table('users')->where($field,'=',$user)->get();

            if($data->count()){
                $this->_data = $data->first();
                return true;
            }
        }
    }

    public function login($username=null,$password=null,$remember=false){

        if(!$username and !$password and $this->exists()){
            Session::put($this->_sessionName,$this->data()->id);
        }else {
            $user = $this->findUser($username);

            if ($user) {
                if (($this->data()->password === Hash::make($password, $this->data()->salt)) or ($this->data()->temp_password === $password)) {
                    Session::put($this->_sessionName, $this->data()->id);
                    if($this->hasPermission('admin')){
                        Session::put('admin','administrator');
                    }
                    if ($remember) {
                        $hash = Hash::unique();
                        $hashCheck = DB::table('user_sessions')->where('user_id',$this->data()->id)->get();

                        if (!$hashCheck->count()) {
                            DB::table('user_sessions')->insert([
                                'user_id' => $this->data()->id,
                                'hash' => $hash
                            ]);
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


    public function hasPermission($key){
        $group = DB::table('groups')->where('id',$this->data()->role)->get();

       
        if($group->count()){
            $permissions= json_decode($group->first()->permission,true);

            if($permissions[$key]==true) {
                return true;

            }
        }
        return false;
    }



    public function exists(){
        return(!empty($this->_data)) ?true : false;
    }

    public function data(){
        return $this->_data;
    }

    public function selectUsers(){
        $users = DB::table('users')->where('name','!=','')->orderBy('total_points','dsc')->get();

        return $users;
    }

    public function selectUser($userId){
        $user = DB::table('users')->where('id',$userId)->first();

        return $user;

    }

    public function logout(){
        DB::table('user_sessions')->where('user_id',$this->data()->id)->delete();

        Session::delete($this->_sessionName);
        Session::delete('username');
        Session::delete('default');
        Session::delete('admin');
        Cookie::delete($this->_cookieName);
    }



    public function isLoggedIn(){
        return $this->_isLoggedIn;
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

    public function achievements(){

        return $this->hasMany('Battleheritage\models\Achievements','user_id');
    }

}