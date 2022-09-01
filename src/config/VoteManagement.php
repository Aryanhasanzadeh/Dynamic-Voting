<?php


return [
    // base prefix 
    'auto_translate' => true,

    "auto_translate_server"=>'google',
    
    
    
    // base prefix 
    'prefix' => 'api',

    // base middleware
    'middleware' => ['auth:sanctum'],

    // vote api's prefix
    'vote_prefix' => 'votes',

    // vote api's middleware
    'vote_middleware' => [],
];