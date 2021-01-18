<?php
/**
 * @package local_helloworld
 * @copyright 2021 Sujith
 * @license GPLv3
 * 
 * 
 * helloworld external functions and service definitions.
 * 
 */

 // got inspired from the forum/db/services.php file
 $functions = [
     'local_helloworld_delete_posts' => [
         'classname' => 'local_helloworld_external',
         'methodname' => 'local_helloworld_delete_posts',
         'classpath' => 'local/helloworld/externallib.php',
         'description' => 'Deletes the posts as manager in hello world plugin',
         'type' => 'write',
         'ajax' => true,
         'capabilities' => 'local/helloworld:deletemessage',
         'loginrequired' => true
     ]
 ];