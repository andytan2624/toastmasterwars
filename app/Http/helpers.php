<?php
/**
 * Given a string, return the array of values and removing empty values
 */
function parseIDString($IDString, $split) {
    $IDArray = array_filter(explode($split, $IDString));
    return $IDArray;
}

/**
 * Determine the current business quarter we are in by the current month we are in
 * @return int
 */
function determineQuarter() {
    $current_month = date("m", time());
    $quarter = 2;
    switch ($current_month) {
        case $current_month <= 3:
            $quarter = 3;
        break;
        case $current_month <= 6:
            $quarter = 4;
        break;
        case $current_month <= 9:
            $quarter = 1;
        break;
    }
    return $quarter;
}

/**
 * Based on the determined quarter currently, return the dates needed for that entire range
 * Year is excluded, and is expected the business code to add the year as necessary
 * @return mixed
 */
function getQuarterDates() {
    $quarter_dates = array(
        1 => array(
            'start_date' => '07-01',
            'end_date' => '09-30',
        ),
        2 => array(
            'start_date' => '10-01',
            'end_date' => '12-31',
        ),
        3 => array(
            'start_date' => '01-01',
            'end_date' => '03-31',
        ),
        4 => array(
            'start_date' => '04-01',
            'end_date' => '06-30',
        ),
    );

    return $quarter_dates[determineQuarter()];
}