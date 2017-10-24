<?php

/* 
 * view/UserView.inc.php
 * @Project: YaddaYaddaYadda
 * @Author: Daniel, Jesper, Marianne & Peter
 */

require_once 'View.inc.php';

class UserView extends View {
    
    public function __construct($model) {
        parent::__construct($model);
    }
    
    private function displayul() {
        $users = Users::retrievem();
        $s = "<div class='haves'>";
        foreach ($users as $user) {
            $s .=  sprintf("%s<br/>\n"
                , $user);
        }
        $s .= "</div>";
        return $s;
    }
    
    private function displayUser() {
        $user = Users::retriveOne();
        $s = "<div class='haves'>";
        if ($user == 'Placeholder') {
            $s .= sprintf("%s<br/>\n" , $user);
        } else {
            echo'Houston we have a problem!';
        }
    }

        private function registerForm() {
        $s = sprintf("
            <form action='%s?f=register' method='post'>\n
            <div class='gets'>\n
                <h3>Create New User</h3>\n
                <p>\n
                    Username:<br/>
                    <input type='text' name='username'/>\n
                </p>\n
                <p>\n
                    Email:<br/>
                    <input type='text' name='email'/>\n
                </p>\n
                <p>\n
                    Name:<br/>
                    <input type='text' name='name'/>\n
                </p>\n
                <p>\n
                    Username:<br/>
                    <input type='file' name='profileimage'/>\n
                </p>\n
                <p>\n
                    Pwd:<br/>
                    <input type='password' name='password'/>\n
                </p>\n
                 <p>\n
                    Pwd repeat:<br/>
                    <input type='password' name='pwd2'/>\n
                </p>\n
                <p>\n
                    <input type='submit' value='Go'/>
                </p>
            </div>", $_SERVER['PHP_SELF']);
                
        if (!Model::areCookiesEnabled()) {
            $s .= "<tr><td colspan='2' class='err'>Cookies 
            from this domain must be 
                      enabled before attempting login.</td></tr>";
        }
        $s .= "          </div>\n";
        $s .= "          </form>\n";
        return $s;
    }
    
    private function displayRegister() {
        $s = sprintf("<main class='main'>\n%s</main>\n"
                    , $this->registerForm());
        return $s;
    }

    public function display(){
       $this->output($this->displayRegister());
    }
    
}
