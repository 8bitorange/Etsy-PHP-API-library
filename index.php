<?php


    ini_set("display_errors","1");
    ERROR_REPORTING(E_ALL);
    
    require_once('etsy_api.php');
    
    /*A set of options may be passed in with only one being required
     * REQUIRED = etsy_key
     * This is the api key given to you by etsy used to verify your account defaults to "null"
     *
     * Optional
     * base_url = may be set manually, defaults to v1
     * cache = turn caching on or off, defaults to false
     * ttl = ammount of time cache should last written in english (ie "+1 hour", "+1 day"); defaults to "+1 hour"
     * tmp_dir = directory to which your cache file can be written must be writable by the server; defaults to "/tmp/"
     */
    
    $options = array(
        'etsy_key' => 'your_key_here',
        'cache' => true,
        'tmp_dir' => 'tmp',
        'ttl' => "+1 minute"
    );
    
    $etsy = new Etsy($options);
    
    /* building an etsy request is easy just supply four things
     * - section of etsy name (ie: users, listings, shops, etc...)
     * - function you would like to call, tried to hold naming convention by using the  method name
     *     without the "getName" part at the beginning. (ie: getUsersByName = byName)
     * - array of options, these are the options available in the etsy method, exactly as they are written there
     * - json true/false, whether you would like a json string(true) or a php json obj (false)
     */
    $test = $etsy->request('listings', 'allListings', array('limit' => 5), false);
    var_dump($test);
    
?>