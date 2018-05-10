<?php

defined('MOODLE_INTERNAL') || die();

function local_videocomp_extend_navigation(global_navigation $navigation) {
    global $PAGE;

    $cm = $PAGE->cm;
    if (!empty($cm) && $cm->modname === 'resource') {
        $context = context_module::instance($cm->id);

        $fs = get_file_storage();
        $files = $fs->get_area_files($context->id, 'mod_resource', 'content', 0, 'sortorder DESC, id ASC', false);
        if (count($files) >= 1) {
            $file = reset($files);
            unset($files);

            if(strpos($file->get_mimetype(), 'video') !== false){
                $PAGE->requires->js_call_amd('local_videocomp/listener', 'initialise', [$cm->id]);
            }
        }
    }
}