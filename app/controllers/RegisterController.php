<?php
namespace App\Controllers;
use Core\Controller;
use Core\Router;
use App\Models\Users;
use App\Models\Login;

class RegisterController extends Controller
{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('Users');
        $this->view->setLayout('default');
    }

    public function loginAction() {
        $loginModel = new Login();
        if($this->request->isPost()) {
            // form validation
            $this->request->csrfCheck();
            $loginModel->assign($this->request->get());
            $loginModel->validator();
            if($loginModel->validationPassed()) {
                $user = $this->UsersModel->findByUsername($_POST['username']);
                if($user && password_verify($this->request->get('password'), $user->password)) {
                    $remember = $loginModel->getRememberMeChecked();
                    $user->login($remember);
                    Router::redirect('');
                }else {
                    $loginModel->addErrorMessage('username', "There is an error with your username and password.");
                }
            }
        }
        $this->view->login = $loginModel;
        $this->view->displayErrors = $loginModel->getErrorMessages();
        $this->view->render('register/login');
    }

    public function logoutAction() {
        if(Users::currentUser()) {
           Users::currentUser()->logout();
        }
        Router::redirect('register/login');
    }

    // public function registerAction() {
    //     $validation = new Validate();
    //     $posted_values = ['fname'=> '', 'lname'=> '', 'email'=> '', 'username'=> '', 'password'=> '', 'confirm'=> ''];
    //     if($_POST) {
    //         $posted_values = FH::posted_values($_POST);
    //         $validation->check($_POST, [
    //             'fname' => [
    //                 'display' => 'First Name',
    //                 'required' => true
    //             ],
    //             'lname' => [
    //                 'display' => 'Last Name',
    //                 'required' => true
    //             ],
    //             'username' => [
    //                 'display' => 'Username',
    //                 'required' => true,
    //                 'unique' => 'users',
    //                 'min' => 6,
    //                 'max' => 150,
    //             ],
    //             'email' => [
    //                 'display' => 'Email',
    //                 'required' => true,
    //                 'unique' => 'users',
    //                 'max' => 150,
    //                 'Valid_email' => true
    //             ],
    //             'password' => [
    //                 'display' => 'Password',
    //                 'required' => true,
    //                 'min' => 6
    //             ],
    //             'confirm' => [
    //                 'display' => 'Confirm Password',
    //                 'required' => true,
    //                 'matches' => 'password'
    //             ]
    //         ], true);

    //         if($validation->passed()) {
    //             $newUser = new Users();
    //             $newUser->registerNewUser($_POST);
    //             Router::redirect('register/login');
    //         }
    //     }
    //     $this->view->post = $posted_values;
    //     $this->view->displayErrors = $validation->displayErrors();
    //     $this->view->render('register/register');
    // }

    public function registerAction() {
        $newUser = new Users();
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $newUser->assign($this->request->get());
            $newUser->setConfirm($this->request->get('confirm'));
            if($newUser->save()){
                Router::redirect('register/login');
            }
        }
        $this->view->newUser = $newUser;
        $this->view->displayErrors = $newUser->getErrorMessages();
        $this->view->render('register/register');
    }
}
