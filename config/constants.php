<?php
/**
 * List of constants used by the system that are score related
 */

return [
    /**
     * Point IDs
     */
    'speech_point_slug' => 'speech',
    'speech_evaluator_point_slug' => 'speech_evaluator',
    'grammarian_slug' => 'grammarian',
    'word_of_the_day_slug' => 'word_of_the_day',
    'toastmaster_slug' => 'toastmaster',
    'toastmaster_alias_array' => array(
        'toastmaster_1',
        'toastmaster_2'
    ),
    /**
     * Form Category slug names
     */
    'speech_form_name' => 'speech_speaker_',
    'speech_evaluator_name' => 'speech_evaluator_',
    /**
     * Array that maps field names to its correct slug name in the database
     */
    'meeting_form_ids_array' => array(
        'attendance_ids' => 'attendance',
        'apologies_ids' => 'apology',
        'absent_ids' => 'absent',
        'visitors_ids' => 'visitor',
        'doing_table_topics_ids' => 'doing_table_topics',
        'table_topics_evaluators_ids' => 'table_topics_evaluation',
    ),
    /**
     *
     */
    'custom_point_category_id' => 34,
];