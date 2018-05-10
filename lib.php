<?php

defined('MOODLE_INTERNAL') || die();

function local_videocomp_extend_navigation(global_navigation $navigation) {
    global $CFG, $PAGE;

    $cm = $PAGE->cm;
    if (!empty($cm) && $cm->modname === 'resource') {
        $PAGE->requires->js_call_amd('local_videocomp/listener', 'initialise', [$cm->id]);
    }
}