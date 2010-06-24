<?php
        
    /* Class: Tags
     * Class for all tags functions in Etsy Api
     * Reference URL: http://developer.etsy.com/docs#tag_and_category_commands
     */
     
    Class Tags extends Etsy {

        /* Functions topTags, childTags
         * takes 2 parameters
         * $params: params are passed through here, all options available through 
         * the etsy api, including required variables
         */
         
         
        /* Function topCategories
         */
        function topCategories($params = array()) {
            
            $request = 'tags';
            $request .= parent::createURL($params);
            
            $result = parent::makeRequest($request);
            
            return $result;
            
        }
        
        
        /* Function childTags
         * required: $params['tag']
         */
        function childTags($params = array()) {
            
            if(!isset($params['tag'])){
                echo "Tag required";
                die();
            }
            
            $request = 'tags/' . $params['tag'] . '/children';
            $request .= parent::createURL($params, array('tag'));
                       
            $result = parent::makeRequest($request);
            
            return $result;
        
        }
                       
    }
    
?>