<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace qbank_customfields;

use core_question\hook\after_question_moved_category;
use qbank_customfields\customfield\question_handler;

/**
 * Hook listener for question bank custom fields.
 *
 * @package    qbank_customfields
 * @copyright  2025 Russell England <russellengland@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class hook_listener {
    /**
     * Update the context for custom field data after a question moves categories
     *
     * @param after_question_moved_category $hook The after question moved category hook.
     */
    public static function update_customfield_context(
        after_question_moved_category $hook,
    ): void {
        $question = $hook->question;

        question_handler::create()->move_question($question->id);
    }
}
