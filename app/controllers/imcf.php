<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 07/11/2016
 * Time: 09:29
 */
use Battleheritage\core\Controller ;

class Imcf extends Controller{

    protected $user;


    public function __construct()
    {
        $this->user = $this->model('User');

    }

    public function index($name = '')
    {


        $this->view('imcf/index');

    }


    public function sword($name = '')
    {


        $this->view('imcf/sword');

    }

    public function longsword($name = '')
    {


        $this->view('imcf/longsword');

    }

    public function polearm($name = '')
    {


        $this->view('imcf/polearm');

    }
}