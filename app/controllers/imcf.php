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
use Battleheritage\models\Longswords;
use Battleheritage\models\Polearms;

use Battleheritage\core\Redirect ;
use Battleheritage\core\Url ;
use Battleheritage\core\Input ;

use Battleheritage\Validation\Contracts\ValidatorInterface;
use Battleheritage\Validation\Validator;
use Battleheritage\Validation\InputForms\AddImcfRecord;

class Imcf extends Controller{

    protected   $user,
                $swords,
                $longswords,
                $polearms,
                $validator;


    public function __construct(){
        
        $this->user = new Users();
        $this->validator = new Validator();
        $this->swords = new Swords();
        $this->longswords = new Longswords();
        $this->polearms = new Polearms();

    }

    public function index($name = ''){

        $this->view('imcf/index');

    }


    public function swords($name = ''){

        $swords = Swords::all()->sortBy('points','0',true);

        $this->view('imcf/swords',['swords'=>$swords]);

    }

    public function longswords($name = ''){

        $longswords = Longswords::all()->sortBy('points','0',true);

        $this->view('imcf/longswords',['longswords'=>$longswords]);

    }

    public function polearms($name = ''){

        $polearms = Polearms::all()->sortBy('points','0',true);

        $this->view('imcf/polearms',['polearms'=>$polearms]);

    }

    public function addRecord($userId = '',$discipline = ''){


        $user = $this->$discipline->where('user_id',$userId)->first();


        if (Input::exists()) {
                $validation = $this->validator->validate($_POST, AddImcfRecord::rules());

                if ($validation->fails()) {

                    // Redirect::to(Url::path().'/home/admin');
                }

                $disciplin = $this->$discipline->updateOrCreate(['user_id' => $userId]
                    ,['win' => ($user->win + Input::get('win')),
                        'loss' => ($user->loss + Input::get('loss')),
                        'points' => ($user->points + (Input::get('win')*2))]);


            Redirect::to(Url::path() . '/imcf/'.$discipline);
            }




        $this->view('imcf/addRecord');

    }
}