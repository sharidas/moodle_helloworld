<?php
/**
 * @package local_helloworld
 * @copyright 2021 Sujith
 * @license GPLv3
 * HelloWorld
 * 
 * A hello world index page
 * 
 */

defined('MOODLE_INTERNAL') || die;
require_once($CFG->libdir . '/formslib.php');

class local_hello_form extends moodleform {
    protected function definition()
    {
        $mform = $this->_form;

        /**
         * This was the first version...
         */
        //$mform->addElement('static', 'stext', 'What is your name?');
        
        //$mform->addElement('text', 'htext', '', ['placeholder' => 'Type your name']);
        //$mform->setType('htext', PARAM_ALPHA);

        /**
         * Here is the modified version to hold messages in form
         */
        $mform->addElement('textarea', 'htext', '', ['placeholder' => 'Type your message!', 'wraps' => 'virtual', 'rows' => '10', 'cols' => '50']);
        $mform->setType('htext', PARAM_TEXT);

        $buttons[] = $mform->createElement('submit', 'submitbutton', 'submit');
        $mform->addGroup($buttons, 'buttonhello', '', ' ', false);
    }
}