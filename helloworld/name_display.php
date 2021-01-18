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
require_login();

$name = required_param('name', PARAM_ALPHA);

$headingStr = 'Hello ' . (string)$name . '!';
$PAGE->set_heading($headingStr);

$PAGE->set_url(new moodle_url('/local/helloworld/index.php',['name' => $name]));

$output = $PAGE->get_renderer('local_helloworld');
echo $output->header();

echo $output->list_items();

echo $output->footer();
