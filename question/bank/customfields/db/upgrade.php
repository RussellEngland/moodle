<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Question Bank Customfields upgrade script.
 *
 * @package     qbank_customfields
 * @copyright   2025 Russell England <russellengland@gmail.com>
 *              Based on work by Mark Johnson <mark.johnson@catalyst-eu.net>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Define upgrade steps to be performed to upgrade the plugin from the old version to the current one.
 *
 * @param int $oldversion Version number the plugin is being upgraded from.
 */
function xmldb_qbank_customfields_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2024100701) {
        // Update question bank custom fields to the correct context.
        // The context might already exist but it might be the wrong context if the question has already been moved.
        // So updating all instances just in case.
        $params = ['component' => 'qbank_customfields', 'area' => 'question'];

        $sql = "SELECT DISTINCT d.instanceid AS id
                FROM {customfield_data} d
                JOIN {customfield_field} f ON f.id = d.fieldid
                JOIN {customfield_category} cat ON cat.id = f.categoryid
                    AND cat.component = :component AND cat.area = :area
                ORDER BY d.instanceid";

        if ($instances = $DB->get_records_sql($sql, $params)) {
            $customfieldhandler = qbank_customfields\customfield\question_handler::create();

            foreach ($instances as $instance) {
                $customfieldhandler->move_question($instance->id);
            }
        }

        // Question Bank Customfields savepoint reached.
        upgrade_plugin_savepoint(true, 2024100701, 'qbank', 'customfields');
    }

    return true;
}
