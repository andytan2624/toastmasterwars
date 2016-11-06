<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Score extends Model
{
    //
    protected $table = 'scores';

    protected $fillable = ['user_id', 'club_id', 'meeting_id', 'point_id', 'point_value', 'is_speech',
    'speech_title', 'evaluator', 'notes'];

    public function point() {
        return $this->belongsTo('App\Models\Point');
    }

    /**
     * Based on $data, create score entries
     * @param $data
     */
    static public function createMeetingScores($input) {

        $points = Point::join('categories' , 'points.category_id', '=', 'categories.id')
            ->where('categories.meeting_order', '!=', -1)
            ->orderBy('categories.meeting_order')
            ->select('points.id', 'points.point_value', 'categories.slug')
            ->get();

        $pointsData = array();

        /**
         * Sort points object into array, indexed by the slug name
         * for easy reference
         */
        foreach ($points as $point) {
            $pointsData[$point->slug] = $point;
        }

        /**
         * Now go through each input and check if there's a corresponding entry in $pointsData array
         */

        $meeting_half = 1;
        foreach ($input as $key => $value) {
            /**
             * If we hit the field toastmaster_2, we're in the second half
             */
            $meeting_half = $key == "second_half_start_point" ? 2 : $meeting_half;

            // Create a new score object here and fill with values we know we have
            $score = new Score($input);
            $score->created_by = Auth::user()->id;
            $score->which_half = $meeting_half;

            /**
             * Create a score record if the key is a slug for a field in the database
             */

            // Change key to toastmaster if its toastmaster_1 or toastmaster_2
            $new_key = in_array($key, config('constants.toastmaster_alias_array')) ? config('constants.toastmaster_slug') : $key;

            if (isset($pointsData[$new_key]) && $value != "") {
                $score->user_id = $value;
                $score->notes = $new_key == config('constants.grammarian_slug') ? $input[config('constants.word_of_the_day_slug')] : '';
                $score->point_id = $pointsData[$new_key]->id;
                $score->point_value = $pointsData[$new_key]->point_value;
            }

            /**
             * If its not in $pointsData, check if the data is a speech or attendance list
             */
            foreach (config('constants.meeting_form_ids_array') as $form_id => $slug) {
                if ($key == $form_id) {
                    $ids = parseIDString($value, "|");
                    // Create a new score for each one
                    foreach ($ids as $id) {
                        $score->user_id = $id;
                        $score->point_id = $pointsData[$slug]->id;
                        $score->point_value = $pointsData[$slug]->point_value;
                    }
                }
            }

            /**
             * Check if the record is a speech, if so, we have to record a speech and
             */
            if (strpos($key, "speech_speaker_") !== false && $value != "") {
                /**
                 * Find the index of the speech, so we can get the title of the speech
                 *, the time of the speech and the evaluator
                 */
                $index = substr($key, -1);
                $speaker_id = $input["speech_speaker_$index"];
                $speaker_evaluator = $input["speech_evaluator_$index"];
                $speaker_title = $input["speech_title_$index"];
                $speaker_time = $input["speech_time_$index"];

                $score->user_id = $speaker_id;
                $score->point_id = $pointsData[config('constants.speech_point_slug')]->id;
                $score->point_value = $pointsData[config('constants.speech_point_slug')]->point_value;
                $score->is_speech = 1;
                $score->speech_title = $speaker_title;
                $score->speaking_time = $speaker_time;
                $score->evaluator = $speaker_evaluator;
            }

            /**
             * Check if the record is a speech, if so, we have to record a speech and
             */
            if (strpos($key, "speech_evaluator_") !== false && $value != "") {
                /**
                 * Find the index of the speech, so we can get the title of the speech
                 *, the time of the speech and the evaluator
                 */
                $index = substr($key, -1);
                $speaker_evaluator = $input["speech_evaluator_$index"];

                // Create a score for the evaluator who evaluated the speech
                $score->user_id = $speaker_evaluator;
                $score->point_id = $pointsData[config('constants.speech_evaluator_point_slug')]->id;
                $score->point_value = $pointsData[config('constants.speech_evaluator_point_slug')]->point_value;
            }

            if (isset($score->point_id)) {
                $score->save();
            }
        }
        /**
         * Redirect back to the scores page
         */
        redirect('ScoreController@dashboard');
    }

    public function displayScore() {
        return $this->point->category->name . ' : ' . $this->point_value . ' points';
    }
}
