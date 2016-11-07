<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 07/11/2016
 * Time: 09:24
 */
class Profight extends Controller
{

    protected $user;


    public function __construct()
    {
        $this->user = $this->model('User');

    }

    public function index($name = '')
    {


        $this->view('profight/index');

    }
}