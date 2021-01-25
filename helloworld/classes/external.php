<?php
/**
 * @package local_helloworld
 * @copyright 2021 Sujith
 * @license GPLv3
 * 
 * 
 * External helloworld API
 * 
 */

defined('MOODLE_INTERNAL') || die;

require_once("$CFG->libdir/externallib.php");
#require_once("$CFG->dirroot/local/helloworld/hellolib.php");
#require_once("$CFG->dirroot/local/helloworld/lib.php");

class local_helloworld_external extends external_api {

    /**
     * Delete the posts of the helloworld plugin
     *
     * @param string $timecreated time when the message created by the user
     * @param string $userid the user id of the user
     * @return array of warnings and status result
     * @since Moodle 3.9
     */
    public static function local_helloworld_delete_posts(string $timecreated, string $userid) {
        global $DB;

        $warnings = [];

        $DB->delete_records('local_helloworld', ['timecreated' => (int)$timecreated, 'userid' => (int)$userid]);
        $result['status'] = true;
        $result['warnings'] = $warnings;
        return $result;
    }

    /**
     * Describe the parameters for local_helloworld_delete_posts
     *
     * @return external_function_parameters
     * @since Moodle 3.9
     */
    public static function local_helloworld_delete_posts_parameters() {
        return new external_function_parameters([
            'timecreated' => new external_value(PARAM_INT, 'time created',VALUE_REQUIRED, 0),
            'userid' => new external_value(PARAM_INT, 'user id as string', VALUE_REQUIRED, 0)
        ]);
    }

    /**
     * Returns description of methods return value
     *
     * @return external_single_structure
     * @since Moodle 3.9
     */
    public static function local_helloworld_delete_posts_returns() {
        return new external_single_structure([
            'status' => new external_value(PARAM_BOOL, 'status: true if success'),
            'warnings' => new external_warnings()
        ]);
    }
}