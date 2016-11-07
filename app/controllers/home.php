<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 03/10/2016
 * Time: 11:39
 */

class Home extends Controller{

    protected   $user;
               

    public function __construct(){
        $this->user = $this->model('User');
       
    }

    public function index($name = ''){

        
        $this->view('home/index');

    }

    public function register($name = ''){

        $user = $this->user;
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                $validate = new Validation();
                $validation = $validate->check($_POST, array(
                    'username' => array(
                        'required' => true,
                        'min' => 4,
                        'max' => 50,
                        'unique' => 'users',
                        'email' => true
                    )
                ));
                if ($validation->passed()) {

                    $salt = Hash::salt(32);

                    try {
                        $user->create(array(
                            'username' => Input::get('username'),
                            'temp_password' => Hash::md5(Input::get('username')),
                            'salt' => $salt,
                            'joined' => date('Y-m-d H:i:s'),
                            'role' => 1
                        ));
                        Email::sendEmail(Input::get('username'),'Your password to log in!','your password is '.Hash::md5(Input::get('username')).'');

                    } catch (Exception $e) {
                        die($e->getMessage());
                    }

                    Message::setMessage('We have sent you temporary password , check your inbox <br> Upon first login you will need to set new password','success');
                    Redirect::to(Url::path().'/main/index');


                } 
            }
        }
    
        $this->view('main/register');
    }

    public function login($name = ''){
        $user = $this->user;

        if(Input::exists()){
            if(Token::check(Input::get('token'))){

                $validate = new Validation();
                $validation = $validate->check($_POST,array(
                    'username'=> array(
                        'required'=>true,
                        'email'   =>true
                    ),
                    'password'=> array(
                        'required'=>true
                    )));
                if($validation->passed()){

                    $remember= (Input::get('remember')==='on') ? true : false;
                    $login = $user->login(Input::get('username'),Input::get('password'),$remember);

                    if($login){
                        Session::put('username',$user->data()->username);
                        if($user->data()->temp_password === Hash::md5(Input::get('username'))){
                            Message::setMessage('You have logged in for the first time, change your password','success') ;
                            Redirect::to(Url::path().'/main/settings');

                        }else{
                            Redirect::to(Url::path().'/main/index');
                        }
                    }else{
                        Message::setMessage('Sorry we couldn\'t log you in','error') ;
                    }
                }
            }
        }

        $this->view('main/login');
    }

    public function settings(){
        $user = $this->user;
        if(!$user->isLoggedIn()){
            Redirect::to('competitions.php');
        }
        if(empty($this->user->data()->temp_password)) {
            if (Input::exists()) {
                if (Token::check(Input::get('token'))) {

                    $validate = new Validation();
                    $validation = $validate->check($_POST, array(
                        'password_current' => array(
                            'required' => true,
                            'min' => 6
                        ),
                        'new_password' => array(
                            'required' => true,
                            'min' => 6
                        ),
                        'new_password_again' => array(
                            'required' => true,
                            'min' => 6,
                            'matches' => 'new_password'
                        )
                    ));
                    if ($validation->passed()) {



                        if ((Hash::make(Input::get('password_current'), $this->user->data()->salt)) === ($this->user->data()->password)) {


                            try {
                                $salt = Hash::salt(32);
                                $user->update(array(
                                    'name' => Input::get('name'),
                                    'password' => Hash::make(Input::get('new_password'), $salt),
                                    'salt' => $salt,
                                    'temp_password' => ''
                                ));

                                Message::setMessage('You have updated your password!', 'success');
                                Redirect::to(Url::path() . '/main/index');

                            } catch (Exception $e) {
                                die($e->getMessage());
                            }

                        } else {
                            Message::setMessage('Invalid Password', 'error');
                        }
                    }
                }
            }
        }else{
            if (Input::exists()) {
                if (Token::check(Input::get('token'))) {

                    $validate = new Validation();
                    $validation = $validate->check($_POST, array(
                        'new_password' => array(
                            'required' => true,
                            'min' => 6
                        ),
                        'new_password_again' => array(
                            'required' => true,
                            'min' => 6,
                            'matches' => 'new_password'
                        )
                    ));
                    if ($validation->passed()) {


                            try {
                                $salt = Hash::salt(32);
                                $user->update(array(
                                    'password' => Hash::make(Input::get('new_password'), $salt),
                                    'salt' => $salt,
                                    'temp_password' => ''
                                ));

                                Message::setMessage('You have updated your password!', 'success');
                                Redirect::to(Url::path() . '/main/index');

                            } catch (Exception $e) {
                                die($e->getMessage());
                            }

                    }
                }
            }

        }

        $this->view('main/settings',['user'=>$user->data()]);
    }

    public function recovery( $name = ''){
        $user = $this->user;
        if(Input::exists()) {
            if (Token::check(Input::get('token'))) {

                $validate = new Validation();
                $validation = $validate->check($_POST,array(
                    'username'=> array(
                        'required'=>true,
                    )
                ));

                if($validation->passed()) {
                    $username =Input::get('username');

                    if($user->userExists($username)) {

                        if ($name == ('username')) {
                            Email::sendEmail(Input::get('username'), 'Your username reminder', $user->data()->username);
                            Message::setMessage('Username has been sent, check your inbox!','success');
                            Redirect::to(Url::path().'/main/login');
                        } else if ($name == ('password')) {
                            $id = $user->userIdFromEmail($username);
                            $user->update(array(
                                'temp_password'=>Hash::md5($username),
                                'password'     => ''
                            ),$id);
                            Email::sendEmail(Input::get('username'), 'Your password reminder', Hash::md5($username));
                            Message::setMessage('Password has been sent, check your inbox!','success');
                            Redirect::to(Url::path().'/main/login');
                        } else {
                            Redirect::to(Url::path().'/main/index');
                        }
                    }else{
                        Message::setMessage('This email address doesn\'t exist in our database, register please','error');
                    }
                }

            }
        }

        

        $this->view('main/recovery');
    }

    public function logout($name = ''){
       
        $this->user->logout();
        Redirect::to(Url::path().'/main/index');

        $this->view('main/logout');
    }

    public function profile($name = ''){
        
        
       
        $this->view('main/profile');
    }

    public function update($update = ''){


        $this->view('main/update');
    }
    
}