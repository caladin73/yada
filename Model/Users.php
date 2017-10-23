<?php

//
// Author : Jesper Uth Krab
// Made On : Oct 23, 2017 2:25:56 PM  
//

error_reporting(E_ALL);

class Users {
    private $Username;
    private $Password;
    private $Email;
    private $Name;
    private $Admin;
    private $Activated;
    private $ProfileImage;
    
    public function getUsername() {
        return $this->Username;
    }
    public function setUsername($Username) {
        $this->Username = $Username;
    }

    public function getPassword() {
        return $this->Password;
    }
    public function setPassword($Password) {
        $this->Password = $Password;
    }
    
    public function getEmail() {
        return $this->Email;
    }
    public function setEmail($Email) {
        $this->Email = $Email;
    }
    
    public function getName() {
        return $this->Name;
    }
    public function setName($Name) {
        $this->Name = $Name;
    }
    
    public function getAdmin() {
        return $this->Admin;
    }
    public function setAdmin($Admin) {
        $this->Admin = $Admin;
    }
    
    public function getActivated() {
        return $this->Activated;
    }
    public function setActivated($Activated) {
        $this->Activated = $Activated;
    }
    
    public function getProfileImage() {
        return $this->ProfileImage;
    }
    public function setProfileImage($ProfileImage) {
        $this->ProfileImage = $ProfileImage;
    }
    
    public function create() {
        
    }
    
    public function activateUser () {
        
    }
    
    public function retrieveMany () {
        
    }
    public function retrieveOne () {
        
    }
    
    public function createObject () {
        
    }
}