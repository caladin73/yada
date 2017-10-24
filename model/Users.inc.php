<?php

//
// Author : Jesper Uth Krab
// Made On : Oct 23, 2017 2:25:56 PM  
//

error_reporting(E_ALL);

class Users {
    private $username;
    private $password;
    private $email;
    private $name;
    private $admin;
    private $activated;
    private $profileImage;
    
    function __construct($Username, $Password, $Email, $Name, $Admin, $Activated, $ProfileImage) {
        $this->username = $Username;
        $this->password = $Password;
        $this->email = $Email;
        $this->name = $Name;
        $this->admin = $Admin;
        $this->activated = $Activated;
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
        $sql = "insert into user (Username, Password, Name, Email, Admin, ProfileImage, Activated) 
                        values (:uid, :pwd, :name, :email, :admin, :profileimg, :activated)";

        $dbh = DbH::connect();
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

        $dbh = dbh::connect();
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
    public function retrieveOne () {
        
    }
    
    public function createObject () {
        
    }
}