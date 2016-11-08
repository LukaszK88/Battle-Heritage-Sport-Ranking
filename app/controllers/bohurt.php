<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 03/10/2016
 * Time: 11:39
 */

use Illuminate\Database\Eloquent\Model;

use Battleheritage\core\Controller ;
use Battleheritage\models\Bohurts ;
use Battleheritage\models\Users ;


class Bohurt extends Controller
{

    protected $users,
            $bohurts;


    public function __construct()
    {
        $this->bohurts = new Bohurts();
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

    public function training($name = '')
    {


        $this->view('bohurt/training');

    }


}