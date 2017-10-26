<?php

/* 
 * model/Yadda.inc.php
 * @Project: YaddaYaddaYadda
 * @Author: Daniel, Jesper, Marianne & Peter
 */

error_reporting(E_ALL);

require_once 'Authentication.inc.php';

class Yadda {
    private $yaddaID;
    private $text;
    private $username;
    private $dateAndTime;
    private $tagList;
    private $imagedata;
    private $imagetype;
    
    function __construct($Text, $Username) {
        $this->text = $Text;
        $this->username = $Username;
    }
    
    public function getYaddaID() {
        return $this->yaddaID;
    }
    public function setYaddaID($YaddaID) {
        $this->yaddaID = $YaddaID;
    }
    
    public function getUsername() {
        return $this->username;
    }
    public function setUsername($Username) {
        $this->username = $Username;
    }
    
    public function getText() {
        return $this->text;
    }
    public function setText($Text) {
        $this->text = $Text;
    }
    
    public function getDateAndTime() {
        return $this->dateAndTime;
    }
    public function setDateAndTime($DateAndTime) {
        $this->dateAndTime = $DateAndTime;
    }
    
    public function getTagList() {
        return $this->tagList;
    }
    public function setTagList($TagList) {
        $this->tagList = $TagList;
    }
    
    function getImagedata() {
        return $this->imagedata;
    }

    function getImagetype() {
        return $this->imagetype;
    }

    function setImagedata($imagedata) {
        $this->imagedata = $imagedata;
    }

    function setImagetype($imagetype) {
        $this->imagetype = $imagetype;
    }

    public function create() {            
                
        $sql = "INSERT INTO Yadda (Text, Username) values (:text, :Username)";
        $dbh = Model::connect();
        
        try {
            $q = $dbh->prepare($sql);
            $q->bindValue(':text', $this->getText());
            $q->bindValue(':Username', $this->getUsername());
            $q->execute();
        } catch(PDOException $e) {
            die("<p>Insert of Yadda failed: <br/>%s</p>\n".
                $e->getMessage());
            
        }
        
        $lastID = $dbh->lastInsertId();
        
        $sql = "INSERT INTO Image (Imagedata, mimetype, YaddaID) values (:imagedata, :imagetype, :yaddaid)";
        
        try {
            $q = $dbh->prepare($sql);
            $q->bindValue(':imagedata', $this->getImagedata());
            $q->bindValue(':imagetype', $this->getImagetype());
            $q->bindValue(':yaddaid', $lastID);
            
            $q->execute();
            $dbh->query('commit');
            
        } catch(PDOException $e) {
            die("<p>Insert of Image failed: <br/>%s</p>\n".
                $e->getMessage());
        }
    }
        
    public static function createObject ($a, $f) {
        
        // TODO aktiver Session fremfor predefined user
        $un = Authentication::getLoginId();
                
        $imagedata = addslashes(file_get_contents($f['img']['tmp_name']));
        $imagetype = $f['img']['type'];
        
        $yadda = new Yadda($a['Text'], $un);
        $yadda->setImagedata($imagedata);
        $yadda->setImagetype($imagetype);
        return $yadda;
    }

    public static function retrieveMany () {
        
        $yaddas = array();
        $dbh = Model::connect();
        
        $sql = "SELECT * FROM view_yaddas_no_replies";
        
        try {
            $q = $dbh->prepare($sql);
            $q->execute();
            while ($row = $q->fetch()) {
                $yadda = self::createObject($row);
                array_push($yaddas, $yadda);
            }   
        } catch (PDOException $e) {
            printf("<P>No Yaddas could be displayed: <br/>%s</p>\n",
                    $e->getMessage());
        } finally {
            return $yaddas;            
        }
   
    }
    public function __toString() {
        $s=$this->getText();
        return $s;
    }

}