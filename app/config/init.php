<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 19/09/2016
 * Time: 13:23
 */
$GLOBALS['config'] = array(
    
    'remember'=>array(
        'cookie_name'=> 'hash',
        'cookie_expiry'=>604800
    ),
    'session'=>array(
        'session_name'=> 'user',
        'token_name'  => 'token'
    ),
    'path' => array(
        'URL'      => 'http://127.0.0.1/battleheritage/public',         // path used for hrefs & css/js location
        'main'     => 'http://127.0.0.1/battleheritage',
    ),
    'default' => array(
        'error_page_controller'    => 'error_handler',
        'header_file'              => '../app/views/includes/head.php',
        'navtop'              => '../app/views/includes/navtop.php',
        'navside'              => '../app/views/includes/navside.php',
        'footer_file'              => '../app/views/includes/footer.php',
        'foot_file'              => '../app/views/includes/foot.php',
    ),
    'logging' => array(
        'enable'                => true,                    // true for enabled, false for disabled
        'enable_php_errors'     => true,                   // same as in php.ini but using ini_set()
    )
);

