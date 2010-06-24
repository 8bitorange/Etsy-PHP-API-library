<?php
    Class Etsy {
        
        /* Etsy PHP Library
         * This library will dynamically instantiate the class required
         * to make the desired request.
         * 
         * This base class will urlencode the options and send request and return
         * the results from etsy's servers.
         *
         *A set of options may be passed in with only one being required
         * REQUIRED = etsy_key
         * This is the api key given to you by etsy used to verify your account
         *
         * Optional
         * base_url = may be set manually, defaults to v1
         * cache = turn caching on or off
         * ttl = ammount of time cache should last written in english (ie "+1 hour", "+1 day");
         * tmp_dir = directory to which your cache file can be written must be writable by the server
         */
                
        //Set variable for base_url to etsy api
        private $base_url = 'http://beta-api.etsy.com/v1/';
        
        //Turn cache on off
        private $cache = false;
        
        //EtsyCache object variable
        private $ecache = null;
        
        //***Etsy key required***
        private $etsy_key = null;
        
        
        /* This method is included for future building, used right now to 
         * include the proper base url
         */
         
        public function __construct($params = array()){
            
            var_dump($params['etsy_key']);
            //set options passed in
            if(isset($params['etsy_key'])){
                $this->etsy_key = $params['etsy_key'];
            } else {
                echo "Etsy key required please include it in the params you pass in";
                die();
            }
            
            if(isset($params['url'])){
                $this->base_url = $params['url'];
            }
            
            if(isset($params['cache'])){
                $this->cache = $params['cache'];
            }
            
            if($this->cache){
                $this->ecache = new EtsyCache($params);
            }    
        }
        
        /* Function request
         * takes 4 parameters
         * $class: the class named used to build the appropriate object
         * $method: the method to call
         * $options: an array of options included required get variables
         * $json: whether to leave in json string (true) or decode to php object(false)
         */
        public function request($class, $method, $options = array(), $json = true){
                        
            //Make sure class is formatted properly and exists.
            if(class_exists(ucwords($class))){
                
                $class = ucwords($class);

            } else {
                echo "There was no class called $class, please make sure you are calling the right etsy parameter"; 
                die();
            }
            
            //process options to be urlencoded
            $options = $this->processOptions($options);
            
            //check to see if there is a cached file and whether it is valid
            //generate key from an md5 of the class, method
            if($this->cache){
                $key = md5($method . $class . serialize($options));
            }
            
            if($this->cache && $this->ecache->check($key)){
                //if valid return cached object
                $result = $this->ecache->get($key);
            } else {
                //instantiate class and call method, create cache
                $result = $class::$method($options, $json);
                
                if($this->cache){
                    
                    //write json string to cached file
                    $this->ecache->write($key, $result);
                    
                }
            }
            //check if object should be php object or json string
            if(!$json){
                $result = json_decode($result);
            }
            
            return $result;
                        
        }

        /* Function processOptions
         * takes 1 parameter
         * $options: an array of options to urlencode
         */
        private function processOptions($options = array()){
            
            //create empty processed array
            $processed = array();
            
            //loop through options and urlencode the value and reset it accordingly
            foreach($options as $item => $val){
                $processed[$item] = urlencode($val);
            }
            
            return $processed;
        
        }
        
        /* Function createURL
         * takes two parameters
         * $params: array of items to be used to create URL
         * $deny: array of items to not add to url
         */
        public function createURL($params = array(), $deny = array()){
            
            $url =  '?api_key=' . $this->etsy_key;
            foreach($params as $item => $val){
                if(!in_array($item, $deny)){
                    $url .= '&' . $item . '=' . $val;
                }
            }
            
            return $url;
            
        }

        /* Function makeRequest
         * takes 1 parameter
         * $url: a url string to include on the base_url for the request
         */        
        public function makeRequest($url = null){
            
            //make sure there is a requested url
            if(is_null($url)){
                echo 'No request was made';
                die();
            }
            
            //put together full request url
            $request = $this->base_url . $url;            
            
            //create curl request and do not include headers.
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, $request); 
            curl_setopt($ch, CURLOPT_HEADER, 0); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            $data = curl_exec($ch);
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (intval($status) != 200) die("Error: $data");
            curl_close($ch);
            
            return $data;

        }
    
    }
?>