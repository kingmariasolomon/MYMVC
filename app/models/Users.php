<?php
namespace App\Models;
use Core\Model;
use App\Models\Users;
use App\Models\UserSessions;
use Core\Cookie;
use Core\Session;
use Core\Validators\MaxValidator ;
use Core\Validators\MinValidator ;
use Core\Validators\RequiredValidator ;
use Core\Validators\EmailValidator ;
use Core\Validators\MatchesValidator ;
use Core\Validators\UniqueValidator ;

class Users extends Model
{
    private $_isLoggedIn, $_sessionName, $_cookieName, $_softdelete, $_confirm;
    public static $currentLoggedInUser = null;
    public $id, $username, $email, $password, $fname, $lname, $acl, $deleted = 0;

    public function __construct($user='') {
        $table = 'users';
        parent::__construct($table);
        $this->_sessionName = CURRENT_USER_SESSION_NAME;
        $this->_cookieName = REMEMBER_ME_COOKIE_NAME;
        $this->_softdelete = true;
        if($user != '') {
            if(is_int($user)) {
                $u = $this->_db->findFirst('users', ['conditions'=>'id = ?', 'bind'=>[$user]], 'App\Models\Users');
            }else {
                $u = $this->_db->findFirst('users', ['conditions'=>'username = ?', 'bind'=>[$user]], 'App\Models\Users');
            }
            if($u) {
                foreach ($u as $key => $val) {
                    $this->$key = $val;
                }
            }
        }
    }

    public function validator(){
        // first name and lastname validation
        $this->runValidation(new RequiredValidator($this, ['field'=>'fname', 'msg'=>'First Name is required.']));
        $this->runValidation(new RequiredValidator($this, ['field'=>'lname', 'msg'=>'Last Name is required.']));

        // email validation
        $this->runValidation(new RequiredValidator($this, ['field'=>'email', 'msg'=>'Email is required.']));
        $this->runValidation(new MaxValidator($this, ['field'=>'email', 'rule'=>150, 'msg'=>'Email Must Be less than 150 Characters.']));
        $this->runValidation(new EmailValidator($this, ['field'=>'email', 'msg'=>'Please enter a valid email address.']));
        $this->runValidation(new UniqueValidator($this, ['field'=>'email', 'msg'=>'The Email already exists. Please choose another one']));

        // $this->runValidation(new NumericValidator($this, ['field'=>'password', 'msg'=>'The password must be a number.']));
        
        // username validation
        $this->runValidation(new MinValidator($this, ['field'=>'username', 'rule'=>6, 'msg'=>'Username Must Be at least Six Characters.']));
        $this->runValidation(new MaxValidator($this, ['field'=>'username', 'rule'=>150, 'msg'=>'Username Must Be less than 150 Characters.']));
        $this->runValidation(new UniqueValidator($this, ['field'=>'username', 'msg'=>'The Username already exists. Please choose another one']));

        // password validation
        $this->runValidation(new RequiredValidator($this, ['field'=>'password', 'msg'=>'Password is required.']));
        $this->runValidation(new MinValidator($this, ['field'=>'password', 'rule'=>6, 'msg'=>'Password Must Be at least Six Characters.']));
        if($this->isNew()){
            $this->runValidation(new MatchesValidator($this, ['field'=>'password', 'rule'=>$this->_confirm, 'msg'=>'Password do  not match.']));
        }
    }

    public function beforeSave(){
        if($this->isNew()){
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }
    }

    public function findByUsername($username){
        return $this->findFirst(['conditions'=>"username = ?", 'bind'=> [$username]]);
    }

    public static function currentUser() {
        if(!isset(self::$currentLoggedInUser) && Session::exists(CURRENT_USER_SESSION_NAME)) {
            $U = new Users((int)Session::get(CURRENT_USER_SESSION_NAME));
            self::$currentLoggedInUser = $U;
        }
        return self::$currentLoggedInUser;
    }

    public function login($rememberMe=false) {
        Session::set($this->_sessionName, $this->id);
        if($rememberMe) {
            $hash = md5(uniqid() + rand(0, 100));
            $user_agent = Session::uagent_no_version();
            Cookie::set($this->_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
            $fields = ['session'=>$hash, 'user_agent'=>$user_agent, 'user_id'=>$this->id];
            $this->_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);
            $this->_db->insert('user_sessions', $fields);
        }
    }

    public static function loginUserFromCookie() {
        $userSession = UserSessions::getFromCookie();
        if ($userSession && $userSession->user_id != '') {
            $user = new self((int)$userSession->user_id);
            if($user) {
                $user->login(); 
            }
            return $user;
        }
        return;
    }

    public function logout() {
        $userSession = UserSessions::getFromCookie();
        if($userSession) $userSession->delete();
        Session::delete(CURRENT_USER_SESSION_NAME);
        if (Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
            Cookie::delete(REMEMBER_ME_COOKIE_NAME);
        }
        self::$currentLoggedInUser = null;
        return true;
    }

    // public function registerNewUser($params) {
    //     $this->assign($params);
    //     $this->deleted = 0;
    //     $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    //     $this->save();
    // }

    public function acls() {
        if(empty($this->acl)) return [];
        return json_decode($this->acl, true);
    }

    public function setConfirm($value) {
        $this->_confirm = $value;
    }

    public function getConfirm() {
        return $this->_confirm;
    }
}