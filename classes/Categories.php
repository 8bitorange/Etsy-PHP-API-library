<?php
        
    /* Class: Categories
     * Class for all categories functions in Etsy Api
     * Reference URL: http://developer.etsy.com/docs#tag_and_category_commands
     */
     
    Class Categories extends Etsy {

        /* Functions topCategories, childCategories
         * takes 2 parameters
         * $params: params are passed through here, all options available through 
         * the etsy api, including required variables
         */
         
         
        /* Function topCategories
         */
        function topCategories($params = array()) {
            
            $request = 'categories';
            $request .= parent::createURL($params);
            
            $result = parent::makeRequest($request);
            
            return $result;
            
        }
        
        
        /* Function childCategories
         * required: $params['category']
         */
        function childCategories($params = array()) {
            
            if(!isset($params['category'])){
                echo "Tag required";
                die();
            }
            
            $request = 'categories/' . $params['category'] . '/children';
            $request .= parent::createURL($params, array('category'));
                       
            $result = parent::makeRequest($request);
            
            return $result;
        
        
        }
                       
    }
    
?>