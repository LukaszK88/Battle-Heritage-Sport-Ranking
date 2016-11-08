<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 03/10/2016
 * Time: 11:39
 */

use Battleheritage\core\Controller ;


class Triathlon extends Controller{

    protected $user;


    public function __construct()
    {
        $this->user = $this->model('User');

    }

    public function index($name = '')
    {


        $this->view('triathlon/index');

    }
}