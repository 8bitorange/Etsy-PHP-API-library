<?php
        
    /* Class: Feedback
     * Class for all feedback functions in Etsy Api
     * Reference URL: http://developer.etsy.com/docs#feedback
     * Extends Users Class due to it using that classes naming
     * structure for all but one method.
     *
     * Considered including these methods in Users Class, but
     * wanted to maintain seperation and naming convention
     */
     
    Class Feedback extends Etsy {
        
        /* Functions feedback, forUser, asBuyer, forOthers, asSeller
         * takes 2 parameters
         * $params: params are passed through here, all options available through 
         * the etsy api, including required variables
         */
         
         
        /* Function feedback
         * required: $params['feedback_id']
         */
        function feedback($params = array()) {
            
            if(!isset($params['feedback_id'])){
                echo "Feedback ID required";
                die();
            }
            
            $request = 'feedback' . '/' . $params['feedback_id'];
            $request .= parent::createURL($params, array('feedback_id'));
            
            $result = parent::makeRequest($request);
            
            return $result;
            
        }
        
        
        /* Function forUser
         * required: $params['user_id']
         */
        function forUser($params = array()) {
            
            if(!isset($params['user_id'])){
                echo "User ID required";
                die();
            }
            
            $request = 'users/' . $params['user_id'] . '/feedback';
            $request .= parent::createURL($params, array('user_id'));
                       
            $result = parent::makeRequest($request);
            
            return $result;
        
        }
        
        
        /* Function asBuyer
         * required: $params['user_id']
         */       
        function asBuyer($params = array()) {
        
            if(!isset($params['user_id'])){
                echo "User ID required";
                die();
            }
            
            $request = 'users/' . $params['user_id'] . '/feedback/buyer' '?api_key=' . ETSY_KEY;
            $request .= parent::createURL($params, array('user_id'));
                       
            $result = parent::makeRequest($request);
            
            return $result;
        
        }
        
        
        /* Function forOthers
         * required: $params['user_id']
         */                
        function forOthers($params = array()) {
        
            if(!isset($params['user_id'])){
                echo "User ID required";
                die();
            }
            
            $request = 'users/' . $params['user_id'] . '/feedback/others';
            $request .= parent::createURL($params, array('user_id'));
                       
            $result = parent::makeRequest($request);
            
            return $result;
        
        }
        
        
        /* Function asSeller
         * required: $params['user_id']
         */
        function asSeller($params = array()) {
        
            if(!isset($params['user_id'])){
                echo "User ID required";
                die();
            }
            
            $request = 'users/' . $params['user_id'] . '/feedback/seller';
            $request .= parent::createURL($params, array('user_id'));
            
            $result = parent::makeRequest($request);
            
            return $result;
        
        }
                
    }
    
?>