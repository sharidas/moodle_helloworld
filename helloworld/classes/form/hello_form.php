<?php
/**
 * @package local_helloworld
 * @copyright 2021 Sujith
 * @license GPLv3
 * HelloWorld
 * 
 * A hello world submit form
 * 
 * Always remember the name of the file and the class name to be same :)
 * 
 */

namespace local_helloworld\form;

defined('MOODLE_INTERNAL') || die;
require_once($CFG->libdir . '/formslib.php');

class hello_form extends \moodleform {
    protected function definition()
    {
        $mform = $this->_form;

        $mform->addElement('textarea', 'htext', '', ['placeholder' => 'Type your message!', 'wraps' => 'virtual', 'rows' => '10', 'cols' => '50']);
        $mform->setType('htext', PARAM_TEXT);

        $buttons[] = $mform->createElement('submit', 'submitbutton', 'submit');
        $mform->addGroup($buttons, 'buttonhello', '', ' ', false);
    }
}