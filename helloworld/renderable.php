<?php
/**
 * @package local_helloworld
 *  @copyright Sujith
 *  @license GPLV3
 *  
 *  The renderable for helloworld
 *
 *  Renderable for helloworld plugin
 */

use core\message\message;

defined('MOODLE_INTERNAL') || die;

class helloworld_list_posts implements renderable, templatable {

    /** @var $message */
    protected $message;

    /** @var $display_date_time */
    protected $display_date_time;

    /** @var $can_delete */
    protected $can_delete;

    /** @var $userid */
    protected $userid;
    
    /** @var $timecreated */
    protected $timecreated;

    public function __construct($message, $display_date_time, $can_delete, $userid, $timecreated)
    {
        $this->message = $message;
        $this->display_date_time = $display_date_time;
        $this->can_delete = $can_delete;
        $this->userid = $userid;
        $this->timecreated = $timecreated;
    }

    /**
     * Export render data suitable for the mustache template.
     *
     * @param renderer_base $output
     * @return stdClass
     */
    public function export_for_template(renderer_base $output)
    {
        $export = new stdClass();
        $export->message = $this->message;
        $export->display_date_time = $this->display_date_time;
        $export->can_delete = $this->can_delete;
        $export->userid = $this->userid;
        $export->timecreated = $this->timecreated;

        return $export;
    }
}