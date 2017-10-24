<?php

//
// Author : Jesper Uth Krab
// Made On : Oct 23, 2017 2:25:56 PM  
//

error_reporting(E_ALL);

require_once 'DbP.inc.php';
require_once 'DbH.inc.php';

class Users extends Model {
    private $username;
    private $password;
    private $email;
    private $name;
    private $admin;
    private $activated;
    private $profileImage;
    
    function __construct($Username, $Password, $Email, $Name, $ProfileImage) {
        $this->username = $Username;
        $this->password = $Password;
        $this->email = $Email;
        $this->name = $Name;
        $this->profileImage = $ProfileImage;
    }

    public function getUsername() {
        return $this->username;
    }
    public function setUsername($Username) {
        $this->username = $Username;
    }

    public function getPassword() {
        return $this->password;
    }
    public function setPassword($Password) {
        $this->password = $Password;
    }
    
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($Email) {
        $this->email = $Email;
    }
    
    public function getName() {
        return $this->name;
    }
    public function setName($Name) {
        $this->name = $Name;
    }
    
    public function getAdmin() {
        return $this->admin;
    }
    public function setAdmin($Admin) {
        $this->admin = $Admin;
    }
    
    public function getActivated() {
        return $this->activated;
    }
    public function setActivated($Activated) {
        $this->activated = $Activated;
    }
    
    public function getProfileImage() {
        return $this->profileImage;
    }
    public function setProfileImage($ProfileImage) {
        $this->profileImage = $ProfileImage;
    }
    
    public function create() {
        $sql = "insert into Users (Username, Password, Name, Email, Admin, ProfilImage, Activated) 
                        values (:uid, :pwd, :name, :email, :admin, :profileimg, :activated)";

        $dbh = Model::connect();
        try {
            $q = $dbh->prepare($sql);
            $q->bindValue(':uid', $this->getUsername());
            $q->bindValue(':pwd', password_hash($this->getPassword(), PASSWORD_DEFAULT));
            $q->bindValue(':name', $this->getName());
            $q->bindValue(':email', $this->getEmail());
            $q->bindValue(':admin', 0);
            $q->bindValue(':profileimg', $this->getProfileImage());
            $q->bindValue(':activated', 0);
            $q->execute();
        } catch(PDOException $e) {
            printf("<p>Insert of user failed: <br/>%s</p>\n",
                $e->getMessage());
        }
        $dbh->query('commit');
    }
    
    public function activateUser () {
        $sql = "UPDATE Users SET activated = (:activated) WHERE username = (:username)";

        $dbh = DbH::connect();
        try {
            $q = $dbh->prepare($sql);
            $q->bindValue(':username', $this->getUsername());
            $q->bindValue(':activated', $this->getActivated());
            $q->execute();
        } catch(PDOException $e) {
            printf("<p>Insert of user failed: <br/>%s</p>\n",
                $e->getMessage());
        }
        $dbh->query('commit');
    }
    
    public function retrieveMany () {
        
    }
    public static function retrieveOne () {
        
    }
    
    public function update() {
        
    }
    
    public static function createObject ($a) {
        $act = isset($a['activated']) ? $a['activated'] : null;
        $user = new Users($a['username'], $a['email'], $a['name'], $a['profileimage'], $act);
        if (isset($a['password'])) {
            $user->setPassword($a['password']);
        }
        return $user;
    }
}