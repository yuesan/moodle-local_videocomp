<?php

namespace mod_simplevideo;

global $DB;

require_once(__DIR__ . '/../../../config.php');
require_once(__DIR__ . '/../lib.php');
require_once(__DIR__ . '/../../../lib/completionlib.php');

$id = required_param('id', PARAM_INT);

confirm_sesskey();

if ($id) {
    $cm = get_coursemodule_from_id('resource', $id, 0, false, MUST_EXIST);
    $course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);
} else {
    die();
}

$completion = new \completion_info($course);
$completion->set_module_viewed($cm);

die();