<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 03/10/2016
 * Time: 11:39
 */

use Battleheritage\core\Controller ;
use Battleheritage\models\Users ;
use Battleheritage\models\Triathlons ;

use Battleheritage\core\Redirect ;
use Battleheritage\core\Url ;
use Battleheritage\core\Input ;

use Battleheritage\Validation\Contracts\ValidatorInterface;
use Battleheritage\Validation\Validator;
use Battleheritage\Validation\InputForms\AddTriathlonRecord;


class Triathlon extends Controller{

    protected   $user,
                $triathlons,
                $validator;


    public function __construct(){

        $this->validator = new Validator();
        $this->triathlons= new Triathlons();
        

    }

    public function index($name = ''){


        $triathlons = Triathlons::all()->sortBy('points','0',true);
        

        $this->view('triathlon/index',['triathlons'=>$triathlons]);

    }
    
    public function addRecord($userId = ''){


        $user = $this->triathlons->where('user_id',$userId)->first();



            if(!$user) {
                if (Input::exists()) {
                    $validation = $this->validator->validate($_POST, AddTriathlonRecord::rules());

                    if ($validation->fails()) {

                        // Redirect::to(Url::path().'/home/admin');
                    }

                    $triathlon = $this->triathlons->firstOrCreate(array(
                        'user_id' => $userId,
                        'win' => Input::get('win'),
                        'loss' => Input::get('loss'),
                        'points' => (Input::get('win')*2)
                    ));

                    $triathlon->save();


                    Redirect::to(Url::path() . '/triathlon/index');
                }

            }elseif($user) {
                if (Input::exists()) {
                    $validation = $this->validator->validate($_POST, AddTriathlonRecord::rules());

                    if ($validation->fails()) {

                        // Redirect::to(Url::path().'/home/admin');
                    }

                    $triathlon = $this->triathlons->where('user_id',$user->user_id)->first();


                    $triathlon->win    = ($triathlon->win + Input::get('win'));
                    $triathlon->loss   = ($triathlon->loss + Input::get('loss'));
                    $triathlon->points = ($triathlon->points + ((Input::get('win')*2)));

                    $triathlon->save();


                    Redirect::to(Url::path() . '/triathlon/index');

                }
            }


            $this->view('triathlon/addRecord');
        }
}