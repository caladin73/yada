<?php

//
// Author : Jesper Uth Krab
// Made On : Oct 23, 2017 3:40:37 PM  
//

error_reporting(E_ALL);

class Listener {
    private $UsernameListener;
    private $UsernameListensTo;
    
    public function getUsernameListener() {
        return $this->UsernameListener;
    }
    public function setUsernameListener($UsernameListener) {
        $this->UsernameListener = $UsernameListener;
    }

    public function getUsernameListensto() {
        return $this->UsernameListensTo;
    }
    public function setUsernameListensto($UsernameListensto) {
        $this->UsernameListensto = $UsernameListensto;
    }
    
    public function retrieveMany () {
        
    }
    
    public function createObject () {
        
    }
}
