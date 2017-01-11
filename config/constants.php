<?php
/**
 * List of constants used by the system that are score related
 */

return [
    /**
     * Point IDs
     */
    'speech_point_slug'           => 'speech',
    'speech_evaluator_point_slug' => 'speech_evaluator',
    'grammarian_slug'             => 'grammarian',
    'word_of_the_day_slug'        => 'word_of_the_day',
    'toastmaster_slug'            => 'toastmaster',
    'toastmaster_alias_array'     => array(
        'toastmaster_1',
        'toastmaster_2',
    ),
    /**
     * Form Category slug names
     */
    'speech_form_name'            => 'speech_speaker_',
    'speech_evaluator_name'       => 'speech_evaluator_',
    /**
     * Array that maps field names to its correct slug name in the database
     */
    'meeting_form_ids_array'      => array(
        'attendance_ids'              => 'attendance',
        'apologies_ids'               => 'apology',
        'absent_ids'                  => 'absent',
        'visitors_ids'                => 'visitor',
        'doing_table_topics_ids'      => 'doing_table_topics',
        'table_topics_evaluators_ids' => 'table_topics_evaluation',
    ),
    /**
     * Category IDs
     */
    'categories'                  => [
        'absent_id'                   => 31,
        'ah_counter_id'               => 17,
        'apology_id'                  => 32,
        'attendance_id'               => 26,
        'chairman_id'                 => 29,
        'custom_point_category_id'    => 34,
        'general_evaluator_id'           => 15,
        'grammarian_id'               => 19,
        'listening_post_id'           => 21,
        'most_ahs_id'                 => 27,
        'most_use_word_id'            => 25,
        'riddle_master_id'            => 20,
        'solving_riddle_id'           => 24,
        'speech_evaluation_id'        => 13,
        'speech_id'                   => 6,
        'table_topics_evaluation_id'  => 12,
        'table_topics_master_id'      => 14,
        'table_topics_participant_id' => 30,
        'table_topics_winner_id'      => 23,
        'timer_id'                    => 16,
        'toast_id'                    => 18,
        'toastmaster_id'              => 22,
        'visitor_id'                  => 33,
    ],
];