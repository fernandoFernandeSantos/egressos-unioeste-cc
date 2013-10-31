<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ErrorHandler
 *
 * @author deivide
 */
class ErrorHandler {
    //put your code here
    public function __construct() {
        
    }
    
    public function alertHandler($var){
        $error = "<script> ".$var." </script>";
    
        return $error;
    }
    
   
    
    
}

?>
