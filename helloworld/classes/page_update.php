<?php
/**
 * @copyright 2021 Sujith
 * @license GPLv3
 * 
 * Update the page
 * 
 * 
 * Add posts to the page
 */

 namespace local_helloworld;

 defined('MOODLE_INTERNAL') || die;
 
 /**
  * A class to update the page.
  */
 class page_update {

    /**
     * Add new post to the function
     *
     * @param string $tablename name of the table to add post
     * @param string $message text message
     * @param integer $timecreated when was the post created
     * @param integer $userid the user who posted the message
     * @return void
     */
    public function add_post(string $tablename, string $message, int $timecreated, int $userid) {
        global $DB;

        // Better to have a try/catch here
        $DB->insert_record(
            $tablename,
            [
                'message' => $message,
                'timecreated' => $timecreated,
                'userid' => $userid,
            ]
        );
    }
 }