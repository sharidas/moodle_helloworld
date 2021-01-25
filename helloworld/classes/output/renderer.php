<?php
/**
 * @package local_helloworld
 *  @copyright Sujith
 *  @license GPLV3
 *  renderer
 *
 *  This is to renderer
 */

namespace local_helloworld\output;

use local_helloworld\output\helloworld_list_posts;
use plugin_renderer_base;

defined('MOODLE_INTERNAL') || die;

 /**
  * A helloworld render
  */

  class renderer extends plugin_renderer_base {
      /**
       * This method returns the template rendered with the context data
       *
       * @param helloworld_list_posts $listposts
       * @return string
       */
      public function render_helloworld_list_posts(helloworld_list_posts $listposts) : string {
          $out = '';

          $context = $listposts->export_for_template($this);
          $out .= $this->render_from_template('local_helloworld/list_posts', $context);

          return $out;
      }
  }
