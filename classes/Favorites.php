<?php
        
    /* Class: Favorites
     * Class for all feedback functions in Etsy Api
     * Reference URL: http://developer.etsy.com/docs#favorites
     *
     * Considered including these methods in their respective Classes, but
     * wanted to maintain seperation and naming convention without
     * combining them needlessly
     */
     
    Class Favorites extends Etsy {
        
        //var $name is left out due to it pulling from multiple places

        /* Functions listing, shop, listingsOfUser, shopsOfUser
         * takes 2 parameters
         * $params: params are passed through here, all options available through 
         * the etsy api, including required variables
         */
         
         
        /* Function listing
         * required: $params['listing_id']
         */
        function listing($params = array()) {
            
            if(!isset($params['listing_id'])){
                echo "Listing ID required";
                die();
            }
            
            $request = 'listings' . '/' . $params['listing_id'] . '/favorers';
            $request .= parent::createURL($params, array('listing_id'));
            
            $result = parent::makeRequest($request);
                        
            return $result;
            
        }
        
        
        /* Function shop
         * required: $params['user_id']
         */
        function forUser($params = array()) {
            
            if(!isset($params['user_id'])){
                echo "User ID required";
                die();
            }
            
            $request = 'shops' . '/' . $params['user_id'] . '/favorers';
            $request .= parent::createURL($params, array('user_id'));
                       
            $result = parent::makeRequest($request);
                        
            return $result;
        
        }
        
        
        /* Function listingsOfUser
         * required: $params['user_id']
         */       
        function listingsOfUser($params = array()) {
        
            if(!isset($params['user_id'])){
                echo "User ID required";
                die();
            }
            
            $request = 'users' . '/' . $params['user_id'] . '/favorites/listings' '?api_key=' . ETSY_KEY;
            $request .= parent::createURL($params, array('user_id'));
                       
            $result = parent::makeRequest($request);
                        
            return $result;
        
        }
        
        
        /* Function shopsOfUser
         * required: $params['user_id']
         */                
        function shopsOfUser($params = array()) {
        
            if(!isset($params['user_id'])){
                echo "User ID required";
                die();
            }
            
            $request = 'users' . '/' . $params['user_id'] . '/favorites/shops';
            $request .= parent::createURL($params, array('user_id'));
                       
            $result = parent::makeRequest($request);
                        
            return $result;
        
        }
              
    }
    
?>