<?php
require_once 'DbH.inc.php';
require_once 'DbP.inc.php';

class test_hieraci_data {
    private $dbname = DbP::DB;
    private $dbuser = DbP::DBUSER;
    private $dbpass = DbP::USERPWD;
    private $dbhost = DbP::DBHOST;
private $link;

function __construct() {
    //$dbname = DbP::DB;
    //$dbuser = DbP::DBUSER;
    //$dbpass = DbP::USERPWD;
    //$dbhost = DbP::DBHOST;
    $this->link = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
}

// $parent is the parent of the children we want to see 
// $level is increased when we go deeper into the tree, 
//        used to display a nice indented tree 
function display_children($parent, $level) { 
    // retrieve all children of $parent 
    $result = $this->link->query('SELECT y.YaddaID 
                                        FROM Yadda y 
                                        WHERE y.YaddaID in (select r.YaddaIDReply 
                                        from Reply r
                                        where r.YaddaID = '.$parent.')');   
    
    // display each child 
    while ($row = mysqli_fetch_array($result)) {   
        // indent and display the title of this child 
        echo str_repeat('x',$level).$row['YaddaID']."n<br />"; 
        // call this function again to display this 
        // child's children 
        $this->display_children($row['YaddaID'], $level+1); 
    } 
} 

public function rebuild_tree($parent, $left) {   
    // the right value of this node is the left value + 1   
    $right = $left+1;   
   
    // get all children of this node   
    $result = $this->link->query('SELECT y.YaddaID 
                                        FROM Yadda y 
                                        WHERE y.YaddaID in (select r.YaddaIDReply 
                                        from Reply r
                                        where r.YaddaID = '.$parent.')');   
    
    if (!$this->link->error) {
        $error = $this->link->error;
    }
    
    while ($row = mysqli_fetch_array($result)) {   
        // recursive execution of this function for each   
        // child of this node   
        // $right is the current right value, which is   
        // incremented by the rebuild_tree function   
        $right = $this->rebuild_tree($row['YaddaID'], $right);   
    }   
   
    // we've got the left value, and now that we've processed   
    // the children of this node we also know the right value   
    $result = $this->link->query('UPDATE Yadda SET lft='.$left.', rght='.   
                                    $right.' WHERE YaddaID="'.$parent.'";');   
    if (!$result) {
        $error = $this->link->error;
    }
    // return the right value of this node + 1   
    return $right+1;   
} 
}