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

namespace core_question\hook;

use stdClass;

/**
 * Hook after a question has moved category.
 *
 * @package    core_question
 * @copyright  2025 Russell England <russellengland@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
#[\core\attribute\label('Allows plugins or features to perform actions after a question moved category.')]
#[\core\attribute\tags('question')]
class after_question_moved_category {
    /**
     * Constructor for the hook.
     *
     * @param stdClass $question The question instance.
     * @param stdClass $newcategory The new category instance.
     */
    public function __construct(
        /** @var stdClass The question instance */
        public readonly stdClass $question,
        /** @var array The category instance */
        public readonly stdClass $newcategory,
    ) {
    }
}
