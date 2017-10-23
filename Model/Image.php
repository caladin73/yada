<?php

//
// Author : Jesper Uth Krab
// Made On : Oct 23, 2017 3:36:14 PM  
//

error_reporting(E_ALL);

require_once 'Yadda.php';

class Image {
    private $Imagedata;
    
    public function getImagedata() {
        return $this->Imagedata;
    }
    public function setImagedata($Imagedata) {
        $this->Imagedata = $Imagedata;
    }
      
    public function construct () {
        
    }
}