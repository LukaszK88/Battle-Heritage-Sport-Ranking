<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 03/10/2016
 * Time: 11:39
 */

class Bohurt extends Controller
{

    protected $user;


    public function __construct()
    {
        $this->user = $this->model('User');

    }

    public function index($name = '')
    {


        $this->view('bohurt/index');

    }
    
    
    
    public function competitions($name = '')
    {


        $this->view('bohurt/competitions');

    }

    public function training($name = '')
    {


        $this->view('bohurt/training');

    }


}