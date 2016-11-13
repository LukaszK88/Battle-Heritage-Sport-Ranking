<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 03/10/2016
 * Time: 11:39
 */

use Battleheritage\core\Controller ;
use Battleheritage\core\Input ;
use Battleheritage\core\Token ;

use Battleheritage\core\Hash ;
use Battleheritage\core\Email ;
use Battleheritage\core\Message ;
use Battleheritage\core\Redirect ;
use Battleheritage\core\Url ;
use Battleheritage\core\Session ;

use Battleheritage\Validation\Contracts\ValidatorInterface;
use Battleheritage\Validation\Validator;
use Battleheritage\Validation\InputForms\AddUser;
use Battleheritage\Validation\InputForms\RegisterUser;
use Battleheritage\Validation\InputForms\LoginUser;
use Battleheritage\Validation\InputForms\UpdatePassword;
use Battleheritage\Validation\InputForms\NewPassword;

use Illuminate\Support\Facades\DB;
use Battleheritage\models\Bohurts ;
use Battleheritage\models\Users ;


class Home extends Controller{

    protected   $user,
                $bohurt,
                $points,
                $validator;
               

    public function __construct(){
        $this->user = new Users();
        $this->bohurt = new Bohurts();
        $this->validator = new Validator();


        

    }

    public function index($name = ''){

        $users = $this->user->selectUsers();

        $this->view('home/index',['users'=>$users,'user'=>$this->user]);

    }

    public function profile($userId = ''){


        $user = $this->user->selectUser($userId);
        if(!$user){
            Redirect::to(Url::path().'/home/index');
        }

        $stats = Users::find($userId);
     

        $this->view('home/profile',['user'=>$user,'stats'=>$stats]);

    }

    public function register($name = ''){


        if (Input::exists()) {
            $validation = $this->validator->validate($_POST, RegisterUser::rules());

            if ($validation->fails()) {

                Redirect::to(Url::path() . '/home/register');
            }

                if($this->user->find(Input::get('email'))){
                    Message::setMessage('Username already exists','error') ;
                }else {


                    $salt = Hash::salt(32);

                    $this->user->updateOrCreate(['id' => 0],
                        ['username' => Input::get('email'),
                            'temp_password' => Hash::md5(Input::get('username')),
                            'salt' => $salt
                        ]);


                    //Email::sendEmail(Input::get('username'),'Your password to log in!','your password is '.Hash::md5(Input::get('username')).'');


                    Message::setMessage('We have sent you temporary password , check your inbox <br> Upon first login you will need to set new password', 'success');
                    Redirect::to(Url::path() . '/home/index');
                }

        }

    
        $this->view('home/register');
    }

    public function login($name = ''){
        $user = $this->user;

        if (Input::exists()) {
            $validation = $this->validator->validate($_POST, LoginUser::rules());

            if ($validation->fails()) {

                Redirect::to(Url::path() . '/home/login');
            }

                    $remember= (Input::get('remember')==='on') ? true : false;
                    $login = $user->login(Input::get('username'),Input::get('password'),$remember);

                    if($login){
                        Session::put('username',$user->data()->username);
                        if(!empty($user->data()->temp_password)){
                            Message::setMessage('You have logged in for the first time, change your password','success') ;
                            Redirect::to(Url::path().'/main/settings');

                        }else{
                            Redirect::to(Url::path().'/main/index');
                        }
                    }else{
                        Message::setMessage('Sorry we couldn\'t log you in','error') ;
                    }
                }
            


        $this->view('home/login');
    }

    public function settings(){
        $user = $this->user;
        if(!$user->isLoggedIn()){
            Redirect::to(Url::path().'/home/index');
        }
        if(empty($this->user->data()->temp_password)) {
            if (Input::exists()) {

                $validation = $this->validator->validate($_POST, UpdatePassword::rules());

                if ($validation->fails()) {

                    Redirect::to(Url::path() . '/home/settings');
                }



                if ((Hash::make(Input::get('password_current'), $this->user->data()->salt)) === ($this->user->data()->password)) {

                    if(Input::get('new_password') != Input::get('new_password_again')){
                        Message::setMessage('Passwords do not match', 'error');
                    }else {


                        $this->user->updateOrCreate(['id' => $this->user->data()->id],
                            [   'password' => Hash::make(Input::get('new_password'), $this->user->data()->salt),
                                'salt' => $this->user->data()->salt,
                                'temp_password' => ''
                            ]);

                        Message::setMessage('You have updated your password!', 'success');
                        Redirect::to(Url::path() . '/home/index');

                    }

                        } else {
                            Message::setMessage('Invalid Password', 'error');
                        }


            }
        }else{
            if (Input::exists()) {

                if(Input::get('new_password') != Input::get('new_password_again')){
                    Message::setMessage('Passwords do not match', 'error');
                }else {


                    $this->user->updateOrCreate(['id' => $this->user->data()->id],
                        [   'password' => Hash::make(Input::get('new_password'), $this->user->data()->salt),
                            'salt' => $this->user->data()->salt,
                            'temp_password' => ''
                        ]);

                    Message::setMessage('You have updated your password!<br>
                                            Now you can fill in your details', 'success');
                    Redirect::to(Url::path() . '/home/admin');


                }
            }

        }

        $this->view('home/settings',['user'=>$user->data()]);
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
                        Message::setMessage('This email address doesn\'t exist in our Validation, register please','error');
                    }
                }

            }
        }

        

        $this->view('main/recovery');
    }

    public function logout($name = ''){
       
        $this->user->logout();
        
        Redirect::to(Url::path().'/home/index');

        $this->view('home/logout');
    }

    public function update($userId = '',$category = ''){

        if(!empty(Input::get('discipline'))){

            Redirect::to(Url::path().'/'.$category.'/addRecord/'.$userId.'/'.Input::get('discipline'));

        }else {

            if ((Input::get('category') == 'imcf')) {

                $category = Input::get('category');

                Redirect::to(Url::path() . '/home/update/' . $userId . '/' . $category);


            } elseif (!empty(Input::get('category'))) {
                Redirect::to(Url::path() . '/' . Input::get('category') . '/addRecord/' . $userId);
            }
        }
        $this->view('home/update',['userId'=>$userId,'category'=>$category]);
    }

    public function admin($id = '',$photoupdate = ''){

        if(!empty($id)){
            $user = $this->user->selectUser($id);
        }else{
            $user='';
        }
        
        
        
        if(Input::exists()) {
            $validation = $this->validator->validate($_POST, AddUser::rules());

            if ($validation->fails()) {
                if (!empty($id)) {
                    Redirect::to(Url::path() . '/home/admin/' . $id);
                }

                Redirect::to(Url::path() . '/home/admin');
            }


            //Input::uploadPhoto('coa');

            $user = $this->user->updateOrCreate(['id' => $this->user->data()->id],
                ['name' => Input::get('name'),
                    'age' => Input::get('age'),
                    'rank' => Input::get('rank'),
                    'weight' => Input::get('weight'),
                    'region' => Url::path() . '/images/' .Input::get('region').'.png',
                    'quote' => Input::get('quote'),
                    'about' => Input::get('about')
                ]);

            Message::setMessage('Fighter added','success');

            Redirect::to(Url::path() . '/home/index');
        }

        $this->view('home/admin',['user'=>$user]);
    }

    public function photo($id = '',$photoupdate = ''){


        $user = $this->user->selectUser($id);

        if(Input::exists()) {
            if ($photoupdate == 'profilePhoto') {
                Input::uploadPhoto('image');

                $user = $this->user->updateOrCreate(['id' => $id], [
                    'image' => Url::path() . '/images/' . $_FILES['image']['name']]);

                //Message::setMessage('Profile photo uploaded','success');

                Redirect::to(Url::path() . '/home/profile/' . $id);

            }elseif ($photoupdate == 'coaPhoto'){
                Input::uploadPhoto('coa');

                $user = $this->user->updateOrCreate(['id' => $id], [
                    'coa' => Url::path() . '/images/' . $_FILES['coa']['name']]);

                Message::setMessage('Coat of arms uploaded','success');

                Redirect::to(Url::path() . '/home/profile/' . $id);

            }
        }


        $this->view('home/photo',['user'=>$user, 'photoUpdate'=>$photoupdate]);

    }

    public function delete($id = ''){


        $this->user->where('id',$id)->delete();

        Message::setMessage('Fighter deleted','success');

        Redirect::to(Url::path() . '/home/index');

        
        $this->view('home/delete');

    }
    
}