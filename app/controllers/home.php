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

        $users = Users::all();

        foreach ($users as $user){
            if(!empty($user->bohurts->points)){
                $bohurtPoints = $user->bohurts->points;
            }else{
                $bohurtPoints = 0;
            }
            if(!empty($user->profights->points)){
                $profightsPoints = $user->profights->points;
            }else{
                $profightsPoints = 0;
            }
            if(!empty($user->swords->points)){
                $swordsPoints = $user->swords->points;
            }else{
                $swordsPoints = 0;
            }
            if(!empty($user->longswords->points)){
                $longswordsPoints = $user->longswords->points;
            }else{
                $longswordsPoints = 0;
            }
            if(!empty($user->polearms->points)){
                $polearmsPoints = $user->polearms->points;
            }else{
                $polearmsPoints = 0;
            }
            if(!empty($user->triathlons->points)){
                $triathlonsPoints = $user->triathlons->points;
            }else{
                $triathlonsPoints = 0;
            }


            $totalPoints = $bohurtPoints+$profightsPoints+$swordsPoints+$longswordsPoints+$polearmsPoints+$triathlonsPoints;

            $user->total_points = $totalPoints;

            $user->save();

        }

    }

    public function index($name = ''){

        $users = Users::where('name','!=','')->groupBy('total_points')->get();

        $this->view('home/index',['users'=>$users]);

    }

    public function profile($userId = ''){

        $user = Users::where('id',$userId)->first();
        if(!$user){
            Redirect::to(Url::path().'/home/index');
        }


        $this->view('home/profile',['user'=>$user]);

    }

    public function register($name = ''){


        if (Input::exists()) {
            $validation = $this->validator->validate($_POST, RegisterUser::rules());

            if ($validation->fails()) {

                Redirect::to(Url::path() . '/home/register');
            }

                $salt = Hash::salt(32);

                      $user = $this->user->create(array(
                            'username' => Input::get('email'),
                            'temp_password' => Hash::md5(Input::get('username')),
                            'salt' => $salt,
                            'created_at' => date('Y-m-d H:i:s'),
                            'active' => 0
                        ));
            
                        $user->save();
                       //Email::sendEmail(Input::get('username'),'Your password to log in!','your password is '.Hash::md5(Input::get('username')).'');


            Message::setMessage('We have sent you temporary password , check your inbox <br> Upon first login you will need to set new password','success');
            Redirect::to(Url::path().'/home/index');

        }

    
        $this->view('home/register');
    }

    public function login($name = ''){
        $user = $this->user;

        if (Input::exists()) {
            $validation = $this->validator->validate($_POST, LoginUser::rules());

            if ($validation->fails()) {

                Redirect::to(Url::path() . '/home/Login');
            }

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
            


        $this->view('home/login');
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
                        Message::setMessage('This email address doesn\'t exist in our Validation, register please','error');
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
            $user = Users::where('id',$id)->first();
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

            $user = $this->user->updateOrCreate(['id' => $id],
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


        $user = Users::where('id',$id)->first();

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


        Users::where('id',$id)->delete();

        Message::setMessage('Fighter deleted','success');

        Redirect::to(Url::path() . '/home/index');

        
        $this->view('home/delete');

    }
    
}