<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 03/10/2016
 * Time: 11:39
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Battleheritage\core\Controller ;
use Battleheritage\core\Input ;
use Battleheritage\core\Redirect ;
use Battleheritage\core\Url ;
use Battleheritage\models\Bohurts ;
use Battleheritage\models\Users ;

use Battleheritage\Validation\Contracts\ValidatorInterface;
use Battleheritage\Validation\Validator;
use Battleheritage\Validation\InputForms\AddBohurtRecord;


class Bohurt extends Controller
{

    protected   $users,
                $validator,
                $bohurts;


    public function __construct()
    {
        $this->bohurts = new Bohurts();
        $this->validator= new Validator();
        $this->users = new Users();
    
    }

    public function index($name = '')
    {
        


        $this->view('bohurt/index');

    }
    
    
    
    public function competitions($name = ''){

      $bohurts =  Bohurts::all()->sortBy('points','0',true);
        
        
        $this->view('bohurt/competitions',['bohurt'=>$bohurts]);

    }

    public function addRecord($userId = ''){

        $user = $this->bohurts->where('user_id',$userId)->first();


        if (Input::exists()) {
                $validation = $this->validator->validate($_POST, AddBohurtRecord::rules());

                if ($validation->fails()) {

                    // Redirect::to(Url::path().'/home/admin');
                }

                $bohurt = $this->bohurts->updateOrCreate(['user_id' => $userId]
                    ,['fights' => ($user->fights + Input::get('fights')),
                        'down' => ($user->down + Input::get('down')),
                        'suicide' => ($user->suicide +Input::get('suicide')),
                        'points' => ($user->points + ((Input::get('fights') - Input::get('down')) - (Input::get('suicide') * 3)))]);

                    Redirect::to(Url::path() . '/bohurt/competitions');
            }


        $this->view('bohurt/addRecord');

    }

    public function training($name = '')
    {


        $this->view('bohurt/training');

    }


}