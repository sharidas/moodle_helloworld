<?php
/**
 * @copyright 2021 Sujith
 * @license GPLv3
 * HelloWorld
 * 
 * Insert a link to index.php on the site front page navigation menu.
 * 
 * Inserting a link to index.php on the site front page. 
 * Lets hope this would help to navigate to name_display.php
 * and preserve the layout
 */

 defined('MOODLE_INTERNAL') || die;
 
 /** 
 * 
 * Insert a link to index.php on the site front page navigation menu.
 * 
 * @param navigation_node $frontpage Node representing the front page in the navigation tree.
 * 
 */

 function local_helloworld_extend_navigation_frontpage(navigation_node $frontpage) {
     if (isloggedin() && !isguestuser()) {
         global $USER;
         $usercontext = context_user::instance($USER->id);
         if (has_capability('local/helloworld:viewmessages', $usercontext) &&
            has_capability('local/helloworld:postmessages', $usercontext)){
                if (get_config('local_helloworld')->showinnavigation === '1') {
                    $frontpage->add(
                        get_string('pluginname', 'local_helloworld'),
                        new moodle_url('/local/helloworld/index.php', ['sesskey' => sesskey()])
                    );
                }
        }
    }
 }