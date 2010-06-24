<?php
        
    /* Class: Shops
     * Class for all shops functions in Etsy Api
     * Reference URL: http://developer.etsy.com/docs#shops
     */
           
    Class Shops extends Etsy {

        /* Functions details, listings, featuredDetails, featuredSellers, byName
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
            
            $request = 'shops/' . $params['user_id'];
            $request .= parent::createURL($params, array('user_id'));
            
            $result = parent::makeRequest($request);
            
            return $result;
            
        }

        /* Function listings
         * required: $params['user_id']
         */          
        function listings($params = array()) {
        
            if(!isset($params['user_id'])){
                echo "Username or partial username required";
                die();
            }
            
            $request = 'shops/' . $params['user_id'] . '/listings?api_key=' . ETSY_KEY;
            $request .= parent::createURL($params, array('user_id'));
                       
            $result = parent::makeRequest($request);
            
            return $result;
        
        }
        
        /* Function featuredDetails
         * required: $params['user_id']
         */                  
        function featuredDetails($params = array()) {
        
            if(!isset($params['user_id'])){
                echo "Username or partial username required";
                die();
            }
            
            $request = 'shops/' . $params['user_id'] . '/listings?api_key=' . ETSY_KEY;
            $request .= parent::createURL($params, array('user_id'));
                       
            $result = parent::makeRequest($request);
            
            return $result;
        
        }

        /* Function featuredSellers
         */                          
        function featuredSellers($params = array()) {
        
            $request = 'shops/featured?api_key=' . ETSY_KEY;
            $request .= parent::createURL($params);
                       
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
            
            $request = 'shops/keywords/' . $params['search_name'];
            $request .= parent::createURL($params, array('search_name'));
                       
            $result = parent::makeRequest($request);
            
            return $result;
        
        }
        
    }
    
?>