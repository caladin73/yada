<?php

//
// Author : Jesper Uth Krab
// Made On : Oct 23, 2017 2:48:38 PM  
//

error_reporting(E_ALL);

class Yadda {
    private $YaddaID;
    private $Text;
    private $Username;
    private $DateAndTime;
    private $TagList;
    
    public function construct () {
        
    }
    
    public function getYaddaID() {
        return $this->YaddaID;
    }
    public function setYaddaID($YaddaID) {
        $this->YaddaID = $YaddaID;
    }
    
    public function getUsername() {
        return $this->Username;
    }
    public function setUsername($Username) {
        $this->Username = $Username;
    }
    
    public function getText() {
        return $this->Text;
    }
    public function setText($Text) {
        $this->Text = $Text;
    }
    
    public function getDateAndTime() {
        return $this->DateAndTime;
    }
    public function setDateAndTime($DateAndTime) {
        $this->DateAndTime = $DateAndTime;
    }
    
    public function getTagList() {
        return $this->TagList;
    }
    public function setTagList($TagList) {
        $this->TagList = $TagList;
    }
    
    public function create() {
        
    }
    
    public function retrieveMany () {
        
    }
}