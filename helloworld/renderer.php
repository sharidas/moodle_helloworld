<?php
/**
 * @package local_helloworld
 *  @copyright Sujith
 *  @license GPLV3
 *  renderer
 *
 *  This is to renderer
 */

 defined('MOODLE_INTERNAL') || die;

 /**
  * A helloworld render
  */

  class local_helloworld_renderer extends plugin_renderer_base {
      public function list_items() {
          if (isloggedin() && !isguestuser()) {
            $mainpage = new moodle_url('/?redirect=0', ['sesskey' => sesskey()]);
            $helloworldPage = new moodle_url('/local/helloworld/index.php');
            $mainpage->out_as_local_url();
            $output = '<ul>
            <li><a href=';
            $output .= '"' . $mainpage . '"';
            $output .= '>' . get_string('link1', 'local_helloworld') . '</a></li>
            <li><a href=';
            $output .= '"' . $helloworldPage . '"';
            $output .= '>'. get_string('link2', 'local_helloworld') . '</a></li>
            </ul>';
            return $output;
          }
      }

      public function list_messages() {
        if (isloggedin() && !isguestuser()) {
            global $DB, $USER;

            $usercontext = context_user::instance($USER->id);
            $db_records = $DB->get_records('local_helloworld', null, 'timecreated DESC');
            $time = new DateTime();

            echo '<div class="card-columns">';
            foreach ($db_records as $record) {
                $time->setTimestamp(intval($record->timecreated));

                $templatecontext = [
                    'userid' => $record->userid,
                    'message' => $record->message,
                    'display_date_time' => userdate($time->getTimestamp()),
                    'timecreated' => $record->timecreated,
                    'can_delete' => has_capability('local/helloworld:deletemessage', $usercontext)
                ];

                echo $this->render_from_template('local_helloworld/helloworld_posts', $templatecontext);
            }
            echo '</div>';
        }
      }
  }