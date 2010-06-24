<?php

    /* Class EtsyCache
     * Basic file caching class
     * Takes in a unique key used to name the files that is hashed from
     * the etsy request that is being made
     * stores only the data that is returned in string format
     * Uses the files created time to compare for caching purposes
     * so no extra data is written to the file.
     */

    class EtsyCache {
        
        //Set Time to last to 1 hour
        var $ttl = '+1 hour';
        
        //Set basic tmp path, this will most likely fail
        var $path = '/tmp/';
        
        /* Constructor
         * Pass in array of parameters currently accepted:
         * TTL - time for the cache to last if not passed defaults to 1 hour
         * Path - Path to the writable directory for cache file.
         */
        function __construct($params = array()){
        
            //set options passed in
            if(array_key_exists('ttl', $params) && !is_null($params['ttl'])) $this->ttl = $params['ttl'];
            if(array_key_exists('tmp_dir', $params) && !is_null($params['tmp_dir'])) $this->path = $params['tmp_dir'];
            
            //make sure tmp path has trailing slash
            if(substr($this->path, -1) !== '/'){
                $this->path .= '/';
            }
        
        }
        
        /* Function check
         * accepts key paramter
         * Checks to see if file exists, then 
         * checks to see if the file is older then allowable
         * cache time(ttl)
         * If it is it destroys the cache and returns false
         */
        function check($key){
                        
            if(is_file($this->path . $key)){
                $destroy_on = strtotime($this->ttl, filectime($this->path . $key));
                if($destroy_on < time()){
                    unlink($this->path . $key);
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
            
        }
        
        /* Function get
         * accepts key parameter
         * reads file in and trims any white space that may
         * have been inadvertantly added and returns it
         */
        function get($key){
            
            $data = file_get_contents($this->path . $key);
            $data = trim($data);
            
            return $data;
            
        }
        
        /* Function write
         * Creates handle for a file with the name key
         * never expected to write to an old file, so always creates and writes
         * If open succeeded it writes the data and returns true
         * Else it prints the error and dies
         */
        function write($key, $data){
            
            $file = fopen($this->path . $key, 'x');
            
            if($file != false){
                fwrite($file, $data);
                fclose($file);
                
                return true;
            } else {
                echo 'The file you are trying to create can not be created, please check your folder permissions';
                die();
            }
            
        }
    
    }
?>