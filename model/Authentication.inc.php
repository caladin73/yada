<?php
   
/* 
 * model/AuthA.inc.php
 * @Project: YaddaYaddaYadda
 * @Author: Daniel, Jesper, Marianne & Peter
 */

require_once 'AuthA.inc.php'; // include the login parent

class Authentication extends AuthA {
    protected function __construct($user, $pwd, $userType) {
        parent::__construct($user, $userType);
        try {
            self::dbLookUp($user, $pwd, $userType);             // invoke auth
            $_SESSION[self::$sessvar] = $this->getUserId();     // succes
            $_SESSION[self::$sessvar] = $this->getUserType();
        }
        catch (Exception $e) {
            self::$logInstance = FALSE;
            unset($_SESSION[self::$sessvar]);                   //miserys
        }      
    }

    public static function authenticate($user, $pwd) {
        if (! self::$logInstance) {
            self::$logInstance = new Authentication($user, $pwd, null);
        }
        return self::$logInstance;
    }

    protected static function dbLookUp($user, $pwd, $userType) {
        // Using prepared statement to prevent SQL injection
        $sql = "select Username, Password, Admin=(:usertype)
                from Users
                where Username = :uid
                and Activated = 1;";
        $dbh = Model::connect();
        try {
            $q = $dbh->prepare($sql);
            $q->bindValue(':uid', $user);
            $q->bindValue(':usertype', $userType);
            $q->execute();
            $row = $q->fetch();
            if (!($row['Username'] === $user
                    && password_verify($pwd, $row['Password']))) { 
                 throw new Exception("Not authenticated", 42);   //misery
            }
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
}