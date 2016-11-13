<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 07/11/2016
 * Time: 09:24
 */
use Battleheritage\core\Controller ;
use Battleheritage\models\Users ;
use Battleheritage\models\Profights;

use Battleheritage\core\Redirect ;
use Battleheritage\core\Url ;
use Battleheritage\core\Input ;

use Battleheritage\Validation\Contracts\ValidatorInterface;
use Battleheritage\Validation\Validator;
use Battleheritage\Validation\InputForms\AddProfightRecord;

class Profight extends Controller
{

    protected   $user,
                $profights,
                $validator;


    public function __construct(){
        $this->user = new Users();
        $this->validator= new Validator();
        $this->profights = new Profights();

    }

    public function index($name = ''){

        $profights = Profights::all()->sortBy('points','0',true);

        $this->view('profight/index',['profights'=>$profights]);

    }

    public function addRecord($userId = ''){

        $user = $this->profights->where('user_id',$userId)->first();

       
            if (Input::exists()) {
                $validation = $this->validator->validate($_POST, AddProfightRecord::rules());

                if ($validation->fails()) {

                    // Redirect::to(Url::path().'/home/admin');
                }

                $profight = $this->profights->updateOrCreate(['user_id' => $userId]
                    ,['win' =>( $user->win + Input::get('win')),
                        'loss' =>($user->loss + Input::get('loss')), 
                        'ko' => ($user->ko + Input::get('ko')),
                     'points' => ($user->points + ((Input::get('win') * 2) + (Input::get('ko') * 3) + (Input::get('loss'))))]);

                $user = $this->user->where('id',$userId)->first();

                $this->user->updateOrCreate(['id' => $userId],
                    ['total_points' => ($user->total_points + ((Input::get('win') * 2) + (Input::get('ko') * 3) + (Input::get('loss'))))]);



                Redirect::to(Url::path() . '/profight/index');
            }
        

        $this->view('profight/addRecord');

    }
}