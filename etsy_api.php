<?php

    /* Etsy autoload and config setter.
     * This file is being called to autoload all classes as well as 
     * to be a placeholder for expanding options and bootstrapping possibly
     * at a later time
     */

    function __autoload($class_name){
        //check if the class is in the correct directory and autoload
        if(is_file('classes/' . $class_name . '.php')){
            require_once('classes/' . $class_name . '.php');
        }
    }
    
?>