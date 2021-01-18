<?php
/**
 * @package local_helloworld
 * @copyright 2021 Sujith
 * @license GPLv3
 * 
 * This file keeps track of the local helloworld plugin
 * 
 * Upgrade file for helloworld plugin
 * 
 */

 defined('MOODLE_INTERNAL') || die;

 /**
  * xmldb_local_helloworld_upgrade upgrades the
  * local_helloworld database when needed
  *
  * This funciton is automatically called when the version
  * number in version.php changes.
  *
  * @param int $oldversion New old version number
  * @return bool
  */
 function xmldb_local_helloworld_upgrade($oldversion) {
     global $DB;

     $dbman = $DB->get_manager();


     if ($oldversion < 2020081811) {
         // Define field userid to be added to local_helloworld.
        $table = new xmldb_table('local_helloworld');
        $field = new xmldb_field('userid', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'timecreated');

        // Conditionally launch add field userid.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Define key userid (foreign) to be added to local_helloworld.
        $table = new xmldb_table('local_helloworld');
        $key = new xmldb_key('userid', XMLDB_KEY_FOREIGN, ['userid'], 'user', ['id']);

        // Launch add key userid.
        $dbman->add_key($table, $key);

        // Helloworld savepoint reached.
        upgrade_plugin_savepoint(true, 2020081811, 'local', 'helloworld');
     }

     return true;
 }