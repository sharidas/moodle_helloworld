<?php
/**
 * @package local_helloworld
 *  @copyright Sujith
 *  @license GPLV3
 *  
 *  display posts
 *
 *  display posts
 */

use local_helloworld\output\helloworld_list_posts;

defined('MOODLE_INTERNAL') || die;

 //equire_once("$CFG->dirroot/local/helloworld/renderable.php");


 class display_posts {

    public function display_posts_with_capability() : string {
        $out = '';
        if (isloggedin() && !isguestuser()) {
            global $DB, $USER, $PAGE;

            $output = $PAGE->get_renderer('local_helloworld');
            $usercontext = context_user::instance($USER->id);
            $db_records = $DB->get_records('local_helloworld', null, 'timecreated DESC');
            $time = new DateTime();

            $can_delete = has_capability('local/helloworld:deletemessage', $usercontext);
            $out = '<div class="card-columns">';
            foreach ($db_records as $record) {
                $time->setTimestamp(intval($record->timecreated));
                $helloworld_post = new helloworld_list_posts(
                                        $record->message,
                                        userdate($time->getTimestamp()),
                                        $can_delete,
                                        $record->userid,
                                        $record->timecreated);

                $out .= $output->render($helloworld_post);
            }
            $out .= '</div>';
        }

        return $out;
    }
 }
