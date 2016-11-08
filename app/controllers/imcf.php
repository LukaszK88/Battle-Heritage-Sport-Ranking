<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 07/11/2016
 * Time: 09:29
 */

use Battleheritage\core\Controller ;
use Battleheritage\models\Users ;
use Battleheritage\models\Swords;
use Battleheritage\models\Longsword;
use Battleheritage\models\Polearm;

use Battleheritage\core\Redirect ;
use Battleheritage\core\Url ;
use Battleheritage\core\Input ;

use Battleheritage\Validation\Contracts\ValidatorInterface;
use Battleheritage\Validation\Validator;
use Battleheritage\Validation\InputForms\AddImcfRecord;

class Imcf extends Controller{

    protected   $user,
                $swords,
                $validator;


    public function __construct()
    {
        $this->user = new Users();
        $this->validator = new Validator();
        $this->swords = new Swords();

    }

    public function index($name = '')
    {


        $this->view('imcf/index');

    }


    public function swords($name = ''){

        $swords = Swords::all()->sortBy('points','0',true);

        echo $swords;

        $this->view('imcf/swords',['swords'=>$swords]);

    }

    public function longsword($name = '')
    {


        $this->view('imcf/longsword');

    }

    public function polearm($name = '')
    {


        $this->view('imcf/polearm');

    }

    public function addRecord($userId = '',$discipline = ''){


        $user = $this->$discipline->where('user_id',$userId)->first();

        echo $user;

        if(!$user) {
            if (Input::exists()) {
                $validation = $this->validator->validate($_POST, AddImcfRecord::rules());

                if ($validation->fails()) {

                    // Redirect::to(Url::path().'/home/admin');
                }

                $disciplin = $this->$discipline->firstOrCreate(array(
                    'user_id' => $userId,
                    'win' => Input::get('win'),
                    'loss' => Input::get('loss'),
                    'points' => (Input::get('win')*2)
                ));

                $disciplin->save();


                Redirect::to(Url::path() . '/imcf/'.$discipline);
            }

        }elseif($user) {
            if (Input::exists()) {
                $validation = $this->validator->validate($_POST, AddImcfRecord::rules());

                if ($validation->fails()) {

                    // Redirect::to(Url::path().'/home/admin');
                }

                $disciplin = $this->$discipline->where('user_id',$user->user_id)->first();


                $disciplin->win    = ($disciplin->win + Input::get('win'));
                $disciplin->loss   = ($disciplin->loss + Input::get('loss'));
                $disciplin->points = ($disciplin->points + ((Input::get('win')*2)));

                $disciplin->save();


                Redirect::to(Url::path() . '/imcf/'.$discipline);

            }
        }



        $this->view('imcf/addRecord');

    }
}