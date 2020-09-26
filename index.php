<?php
    use Core\Session;
    use Core\Cookie;
    use Core\Router;
    use App\Models\Users;
    
    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT', dirname(__FILE__));

    // load configuration and helper functions
    require_once(ROOT. DS. 'config' . DS . 'config.php');

    // Autoload classes
    // function autoload($className) {
    //     if(file_exists(ROOT .DS . 'core' . DS . $className . '.php')){
    //         require_once(ROOT .DS . 'core' . DS . $className . '.php');
    //     }elseif (file_exists(ROOT . DS  . 'app' . DS . 'controllers' . DS . $className . '.php')){
    //         require_once(ROOT . DS  . 'app' . DS . 'controllers' . DS . $className . '.php');
    //     }elseif (file_exists(ROOT . DS  . 'app' . DS . 'models' . DS . $className . '.php')){
    //         require_once(ROOT . DS  . 'app' . DS . 'models' . DS . $className . '.php');
    //     }elseif (file_exists(ROOT . DS . 'app' . DS . 'custom_validators' .DS . $className . '.php')) {
    //         require_once(ROOT . DS . 'app' . DS . 'custom_validators' .DS . $className . '.php');
    //     }elseif (file_exists(ROOT . DS . 'core' . DS . 'validators' .DS . $className . '.php')) {
    //         require_once(ROOT . DS . 'core' . DS . 'validators' .DS . $className . '.php');
    //     }
    // }

    function autoload($className){
        $classAry = explode('\\', $className);
        $class = array_pop($classAry);
        $subPath = strtolower(implode(DS, $classAry));
        $path = ROOT . DS . $subPath . DS . $class . '.php';
        if(file_exists($path)){
            require_once($path);
        }
    }

    spl_autoload_register('autoload');
    session_start();

    $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];

    if(!Session::exists(CURRENT_USER_SESSION_NAME) && Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
        Users::loginUserFromCookie();
    }
    
    //  Route the request
    Router::route($url);