<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Database\Eloquent\SoftDeletes;


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
    public function createMeetingScores($input) {

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
         * Now go through each input and check if there's a corresponding entry
         * in $pointsData array
         */

        $meeting_half = 1;
        foreach ($input as $key => $value) {
            /**
             * If we hit the field toastmaster_2, we're in the second half
             */
            if ($key == "toastmaster_2") {
                $meeting_half = 2;
            }

            /**
             * Create a score record if the key is a slug for a field in the database
             */
            if (isset($pointsData[$key]) && $value != "") {
                $score = new Score();
                $score->evaluator = null;
                $score->which_half = $meeting_half;
                $score->club_id = $input['club_id'];
                $score->meeting_id = $input['meeting_id'];
                $score->user_id = $value;
                $score->notes = $key == config('constants.grammarian_slug') ? $input[config('constants.word_of_the_day_slug')] : '';
                $score->point_id = $pointsData[$key]->id;
                $score->point_value = $pointsData[$key]->point_value;
                $score->save();
            }
            /**
             * If its not in $pointsData, check if the data is a speech or attendance list
             */
            foreach (config('constants.meeting_form_ids_array') as $form_id => $slug) {
                if ($key == $form_id) {
                    $ids = parseIDString($value, "|");
                    // Create a new score for each one
                    foreach ($ids as $id) {
                        $score = new Score();
                        $score->which_half = $meeting_half;
                        $score->club_id = $input['club_id'];
                        $score->meeting_id = $input['meeting_id'];
                        $score->user_id = $id;
                        $score->point_id = $pointsData[$slug]->id;
                        $score->point_value = $pointsData[$slug]->point_value;
                        $score->save();
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

                $speaker_score = new Score();
                $speaker_score->which_half = $meeting_half;
                $speaker_score->club_id = $input['club_id'];
                $speaker_score->meeting_id = $input['meeting_id'];
                $speaker_score->user_id = $speaker_id;
                $speaker_score->point_id = $pointsData[config('constants.speech_point_slug')]->id;
                $speaker_score->point_value = $pointsData[config('constants.speech_point_slug')]->point_value;
                $speaker_score->is_speech = 1;
                $speaker_score->speech_title = $speaker_title;
                $speaker_score->speaking_time = $speaker_time;
                $speaker_score->evaluator = $speaker_evaluator;
                $speaker_score->save();

                // Create a score for the evaluator who evaluated the speech
                $evaluator_score = new Score();
                $evaluator_score->which_half = $meeting_half;
                $evaluator_score->club_id = $input['club_id'];
                $evaluator_score->meeting_id = $input['meeting_id'];
                $evaluator_score->user_id = $speaker_evaluator;
                $evaluator_score->point_id = $pointsData[config('constants.speech_evaluator_point_slug')]->id;
                $evaluator_score->point_value = $pointsData[config('constants.speech_evaluator_point_slug')]->point_value;
                $evaluator_score->save();
            }
        }
        /**
         * Redirect back to the scores page
         */
        redirect('ScoreController@index');
    }

    public function createScore($id) {

        // Score::create($input);
    }
}
