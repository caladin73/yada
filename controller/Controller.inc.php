<?php
/**
 * controller/Controller.inc.php
 * @author 
 * @copyright (c) 2017, 
 * @license http://www.fsf.org/licensing/ GPLv3
 */
require_once './model/Model.inc.php';
require_once './model/Users.inc.php';
require_once './view/LoginView.inc.php';
require_once './view/UserView.inc.php';

class Controller {
    private $model; // bliver sat i action()
    private $get;
    private $post;
    private $function;
    // are cookies allowed

    // Called with param in URL: ?f=
    public function action() {
        switch ($this->function) {
            case 'login':   //auth
                $this->model = new Users(null, null, null, null, null, null, null);
                $view1 = new LoginView($this->model); //TODO
                if (count($this->post) > 0) {
                    $this->auth($this->post);
                }
                $view1->display();
                break;
            case 'logout':   //logout
                $this->model = new User(null, null, null);
                $view1 = new LoginView($this->model);
                $this->logout();
                $view1->display();
                break;
            case 'register':   //user create
                $this->model = new Users(null, null, null, null, null, null, null); // init a model
                $view1 = new UserView($this->model);// init a view
                if (count($this->post) > 0) {
                    $this->createUser($this->post);               // activate controller
                }
                $view1->display();
                break;
            case 'Ue':   //user edit 
                $this->model = new Users(null, null, null, null, null, null, null); // init a model
                $view1 = new UserEditView($this->model);                  // init a view
                $view1->display();
                break;
            case 'Udb':   //user edit 
                $this->model = new Users(null, null, null, null, null, null, null); // init a model
                if (count($this->post) > 0) {
                    $this->updateUser($this->post['uid']);               // activate controller
                }
                header("Location: ./index.php");
                break;
            //case osv...
        }
    }
    
    public function __construct($get, $post) {
        //$this->model = $model;
        $this->get = $get;
        $this->post = $post;
        foreach ($get as $key => $value) {
            $$key = $value;
        }
        $this->function = isset($f) ? $f : 'login';
    }

    public function auth($p) {
        if (isset($p) && count($p) > 0) {
            if (!Authentication::isAuthenticated() 
                    && Model::areCookiesEnabled()
                    && isset($p['uid'])
                    && isset($p['pwd'])) {
                        Authentication::authenticate($p['uid'], $p['pwd']);
            }
            $p = array();
        }
        return;
    }
    
    /*
     * TODO: denne skal også være med i UML.
     * Eller skal den hedde noget med 'update'?
     */
    public function activateUser($p) {
        if (isset($p) && count($p) > 0) {
            User::activateUser(); 
        }
    }
    
    public function createYadda($p) {
        if (isset($p) && count($p) > 0) {
            $p['id'] = null; // augment array with dummy
            $yadda = Yadda::createObject($p);  // object from array
            $yadda->create();         // model method to insert into db
            $p = array();
        }
        return;
    }    

    public function createUser($p) {
        if (isset($p) && count($p) > 0) {
            $p['id'] = null; // augment array with dummy
            $user = Users::createObject($p);  // object from array
            $user->create();         // model method to insert into db
            $p = array();
        }
        return;
    }
    
    public function createListener($p) {
        if (isset($p) && count($p) > 0) {
            $p['id'] = null; // augment array with dummy
            $user = Listener::createObject($p);  // object from array
            $user->create();         // model method to insert into db
            $p = array();
        }
        return;
    }
        
    public function logout() {
        Authentication::Logout();
        return;
    }
}