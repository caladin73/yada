<?php

/* 
 * view/YaddaView.inc.php
 * @Project: YaddaYaddaYadda
 * @Author: Daniel, Jesper, Marianne & Peter
 */

require_once 'view/View.inc.php';

class YaddaView extends View {
    
    public function __construct($model) {
        parent::__construct($model);
    }
    
    private function displayManyYaddas() {
        
        $yaddas = Yadda::retrieveMany(); // hovedyaddas
        //$data = new test_hieraci_data();
                
        $s = "<div class='yaddas'>\n";
        foreach ($yaddas as $yadda) {
            $s .=  sprintf("%s<br />\n"
                , $yadda);
            
            $nodes = "";
            $nodes = Yadda::getChildren($yadda->getYaddaID(), 1, $nodes);
            $s .= $nodes;
        }
        $s .= "</div>\n";
        return $s;
    }
    
    private function yaddaForm() {
        $s = sprintf("
            <form action='%s?f=yadda' method='post' enctype='multipart/form-data'>\n
            <div class='gets'>\n
                <h3>Post a Yadda &trade;!</h3>\n
                <p>\n
                    Message:<br/>
                    <input type='text' name='text' required />\n
                </p>\n
                <p>\n
                    Image:<br/>
                    <input type='hidden' name='MAX_FILE_SIZE' value='131072'/>
                    <input type='file' name='img' accept='image/*' required/>\n
                </p>\n
                <p>\n
                    <input type='submit' value='Go'/>
                </p>
            </div>", $_SERVER['PHP_SELF']);
        
        $s .= "          </div>\n";
        $s .= "          </form>\n";
        return $s;
    }
    
    private function displayYadda() {
        $s = sprintf("<main class='main'>\n%s\n%s</main>\n"
                    , $this->yaddaForm()
                    , $this->displayManyYaddas());
        return $s;
    }
    
    public function display() {
        $this->output($this->displayYadda());
    }   
}