<?php

defined('MOODLE_INTERNAL') || die;

require_once "$CFG->libdir/externallib.php";
require_once "$CFG->libdir/completionlib.php";

class local_videocomp_external extends external_api {
    public static function set_module_viewed_is_allowed_from_ajax() {
        return true;
    }

    public static function set_module_viewed_parameters() {
        return new external_function_parameters(
                ['cmid' => new external_value(PARAM_INT, 'cmid')]
        );
    }

    public static function set_module_viewed($cmid) {
        global $DB;

        $cm = get_coursemodule_from_id('resource', $cmid, 0, false, MUST_EXIST);
        $course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);

        $completion = new \completion_info($course);
        $completion->set_module_viewed($cm);

        return ['cmid' => $cmid];
    }

    public static function set_module_viewed_returns() {
        global $USER;

        return new external_single_structure(
                [
                        'cmid' => new external_value(PARAM_TEXT, 'cmid'),
                        'userid' => $USER->id
                ],
                'description'
        );
    }
}
