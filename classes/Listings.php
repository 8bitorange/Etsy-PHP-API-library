<?php
        
    /* Class: Listings
     * Class for all listings functions in Etsy Api
     * Reference URL: http://developer.etsy.com/docs#listings
     */
         
    Class Listings extends Etsy {
                
        /* Functions details, allListings, byCategory, byColor, byColorAndKeywords
         * frontFeaturedListings, byKeywords, byMaterials, byTags
         * takes 2 parameters
         * $params: params are passed through here, all options available through 
         * the etsy api, including required variables
         */
         
         
        /* Function details
         * required: $params['listing_id']
         */
        function details($params = array()) {
            
            if(!isset($params['listing_id'])){
                echo "Listing ID required";
                die();
            }
            
            $request = 'listings/' . $params['listing_id'];
            $request .= parent::createURL($params, array('listing_id'));
            
            $result = parent::makeRequest($request);
            
            return $result;
            
        }

        /* Function allListings
         */        
        function allListings($params = array()) {
            
            $request = 'listings/all';
            $request .= parent::createURL($params);
                       
            $result = parent::makeRequest($request);
            
            return $result;
        
        }
        
        /* Function byCategory
         * required: $params['category']
         */                
        function byCategory($params = array()) {
        
            if(!isset($params['category'])){
                echo "Category required";
                die();
            }
            
            $request = 'listings/category/' . $params['category'];
            $request .= parent::createURL($params, array('category'));
                       
            $result = parent::makeRequest($request);
            
            return $result;
        
        }

        /* Function byColor
         * required: $params['color']
         * Can be either HSV or HEX
         */                        
        function byColor($params = array()) {
        
            if(!isset($params['color'])){
                echo "Color required";
                die();
            }
            
            $request = 'listings/color/' . $params['color'];
            $request .= parent::createURL($params, array('color'));
                       
            $result = parent::makeRequest($request);
            
            return $result;
        
        }

        /* Function byColorAndKeywords
         * required: $params['color'] and $params['keywords']
         * Color can be either HSV or HEX
         * Keywords can be seperated by spaces or semi-colons
         */        
        function byColorAndKeywords($params = array()) {
        
            if(!isset($params['color']) && !isset($params['keywords'])){
                echo "Color and keywords required";
                die();
            }
            
            $request = 'listings/color/' . $params['color'] . '/keywords/' . $params['keywords'];
            $request .= parent::createURL($params, array('keywords', 'color'));
            
            $result = parent::makeRequest($request);
            
            return $result;
        
        }

        /* Function frontFeaturedListings
         */        
        function frontFeaturedListings($params = array()) {
            
            $request = 'listings/featured/front/';
            $request .= parent::createURL($params);
            
            $result = parent::makeRequest($request);
            
            return $result;
        
        }

        /* Function byKeywords
         * required: $params['keywords']
         * Keywords can be seperated by space or semicolons
         */        
        function byKeywords($params = array()) {
        
            if(!isset($params['keywords'])){
                echo "Keywords required";
                die();
            }
            
            $request = 'listings/keywords/' . $params['keywords'];
            $request .= parent::createURL($params, array('keywords'));
                       
            $result = parent::makeRequest($request);
            
            return $result;
        
        }
        
        /* Function byMaterials
         * required: $params['materials']
         * Materials can be seperated by space or semicolons
         */         
        function byMaterials($params = array()) {
        
            if(!isset($params['materials'])){
                echo "Materials required";
                die();
            }
            
            $request = 'listings/materials/' . $params['materials'];
            $request .= parent::createURL($params, array('materials'));
                       
            $result = parent::makeRequest($request);
            
            return $result;
        
        }
        
        /* Function byTags
         * required: $params['tags']
         * tags can be seperated by space or semicolons
         */         
        function byTags($params = array()) {
        
            if(!isset($params['tags'])){
                echo "Tags required";
                die();
            }
            
            $request = 'listings/tags/' . $params['tags'];
            $request .= parent::createURL($params, array('tags'));
                       
            $result = parent::makeRequest($request);
            
            return $result;
        
        }        
        
    }
    
?>