<?php

    /* Class: Users
     * Class for all users functions in Etsy Api
     * Reference URL: http://developer.etsy.com/docs#users
     */
    
    Class Users extends Etsy {
        
        /* Functions details, byName
         * takes 2 parameters
         * $params: params are passed through here, all options available through 
         * the etsy api, including required variables
         */
         
         
        /* Function details
         * required: $params['user_id']
         */         
        function details($params = array()) {
            
            if(!isset($params['user_id'])){
                echo "User ID required";
                die();
            }
            
            
            
            $request = 'users/' . $params['user_id'];
            $request .= parent::createURL($params, array('user_id'));
            
            $result = parent::makeRequest($request);
            
            return $result;
            
        }

        /* Function byName
         * required: $params['search_name']
         */            
        function byName($params = array()) {
        
            if(!isset($params['search_name'])){
                echo "Username or partial username required";
                die();
            }
            
            $request = 'users/keywords/' . $params['search_name'];
            $request .= $this->createURL($params, array('search_name'));
                        
            $result = $this->makeRequest($request);
            
            return $result;
        
        }
        
    }
    
?>