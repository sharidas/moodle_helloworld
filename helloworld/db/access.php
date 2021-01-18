<?php
/**
 * @copyright 2021 Sujith
 * @license GPLv3
 * 
 * Plugin capabilities
 * 
 * 
 * Add capabilities for this plugin
 */

 defined('MOODLE_INTERNAL') || die;

 $capabilities = array(
     
    'local/helloworld:deletemessage' => array(

        'riskbitmask' => RISK_XSS,

        'captype' => 'write',
        'contextlevel' => CONTEXT_USER,
        'archetypes' => array(
            'manager' => CAP_ALLOW
        )
    ),
    
    'local/helloworld:postmessages' => array(

        'riskbitmask' => RISK_SPAM,

        'captype' => 'write',
        'contextlevel' => CONTEXT_USER,
        'archetypes' => array(
            'user' => CAP_ALLOW
        )
    ),

    'local/helloworld:viewmessages' => array(

        'captype' => 'read',
        'contextlevel' => CONTEXT_USER,
        'archetypes' => array(
            'user' => CAP_ALLOW
        )
    ),
    
 );