<?php

/* 
 * view/View.inc.php
 * @Project: YaddaYaddaYadda
 * @Author: Daniel, Jesper, Marianne & Peter
 */

abstract class View {
    
    protected $model;
    
    public function __construct($model) {
        $this->model = $model;        
    }
    
    private function top() {
        $s = sprintf("<!doctype html>
<html>
  <head>
    <meta charset='utf-8'/>
    <title>YaddaYaddaYadda &trade;</title>
    <link rel='stylesheet' href='./css/styles.css'/>
  </head>
  <body>
");
        return $s;
    }
    
    private function bottom() {
        $s = sprintf("
     <footer>
     </footer>
  </body>
</html>");
        return $s;
    }
    
    private function topmenu() {
        $s = sprintf("        <header>
            <h1>YaddaYaddaYadda &trade;</h1>\n
            <ul id='menu'>\n
                <li><a href='%s?=home'>Home</a></li>\n",
                $_SERVER['PHP_SELF']);
        if (Authentication::isAuthenticated()) {
            $s .= sprintf("               
                <li><a href='%s?f=yadda'>Yaddas</a></li>\n
                <li><a href='%s?f=profile'>Profile</a></li>\n",
                $_SERVER['PHP_SELF'], $_SERVER['PHP_SELF'], $_SERVER['PHP_SELF'], $_SERVER['PHP_SELF']);
        } else {
            $s .= sprintf("                <li><a href='%s?f=register'>Register User</a></li>\n",
                $_SERVER['PHP_SELF']);
        }
        if (!Authentication::isAuthenticated()) {
            $s .= sprintf("                 <li><a href='%s?f=login'>Login</a></li>\n"
                    , $_SERVER['PHP_SELF']);
        } else { 
            $s .= sprintf("                 <li><a href='%s?f=logout'>Logout</a></li>\n"
                    , $_SERVER['PHP_SELF']);
        }
        $s .= sprintf("             </ul>\n        </header>\n");
        
        if (Authentication::isAuthenticated()) {
            $s .= sprintf("<div>Welcome %s</div>", Authentication::getLoginId());
        }
        return $s;
    }
    
    public function output($s) {
        print($this->top());
        print($this->topmenu());
        printf("%s", $s);
        print($this->bottom());
    }
    
}

