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

 require_once('../../config.php');
 require_once('./hellolib.php');
 //require_once('./name_display.php');

 require_login();
 require_sesskey();

 if (isguestuser()) {
     print_error('noguest');
 }

 $usercontext = $usercontext = context_user::instance($USER->id);

 if (!has_capability('local/helloworld:viewmessages', $usercontext) &&
    !has_capability('local/helloworld:postmessages', $usercontext)){
        print_error('Thats an invalid user');
}

 $name = optional_param('name', '', PARAM_ALPHA);
 if (!$name) {
     $name = fullname($USER);
 }
 
 $context = context_system::instance();
 $PAGE->set_context($context);
 $PAGE->set_pagelayout('standard');
 $PAGE->set_title(get_string('welcome', 'local_helloworld'));
 $headingStr = 'Hello ' . (string)$name . '!';
 $PAGE->set_heading($headingStr);
 
 $PAGE->requires->js_call_amd('local_helloworld/hello_post_delete', 'init');
 
 $PAGE->set_url(new moodle_url('/local/helloworld', ['sesskey' => sesskey()]));

//form display
$form = new local_hello_form();

if ($form->is_validated() && $form->is_submitted()) {
    /**
     * Earlier version it was used for user name
     */
    //$form_name = $form->get_data()->htext;

    /**
     * New version is using it for plain text(text area)
     */
    $textdata = $form->get_data()->htext;

    //$PAGE->set_url(new moodle_url('/local/helloworld/index.php'), ['name' => $form_name]);
    /**
     * Old set_url
     */
    //$PAGE->set_url(new moodle_url('/local/helloworld/name_display.php', ['name' => $form_name]));

    /**
     * New set_url
     */
    $PAGE->set_url(new moodle_url('/local/helloworld/name_display.php', ['sesskey' => sesskey()]));
    
    
    /**
     * The first version where I redirected the code to name_display.php
     */
    //redirect($PAGE->url);

    /**
     * The new version here ..
     * Let's persist the data to local_helloworld database
     */
    $time = new DateTime('now', core_date::get_user_timezone_object());

    $DB->insert_record(
        'local_helloworld', 
        [
            'message' => $textdata,
            'timecreated' => $time->getTimestamp(),
            'userid' => $USER->id,
        ]
    );

    redirect(new moodle_url('/local/helloworld', ['sesskey' => sesskey()]));
}

$output = $PAGE->get_renderer('local_helloworld');
echo $OUTPUT->header();
$form->display();
echo $OUTPUT->box(get_string('greeting', 'local_helloworld', format_string($name)));
echo "<br>";


$output->list_messages();

echo $OUTPUT->footer();