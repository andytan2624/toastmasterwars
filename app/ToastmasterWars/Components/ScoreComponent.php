<?php
namespace App\ToastmasterWars\Components;

use App\Models\Scores\RecordScore;

class ScoreComponent
{

    public function recordIndividualScores($input, $meetingPointSlugs)
    {
        foreach ($input as $pointSlug => $userID) {

            $input['which_half'] = $pointSlug == "toastmaster_2" ? 2 : $input['which_half'];

            // Change $pointSlug to toastmaster if its toastmaster_1 or toastmaster_2
            $pointSlug = in_array($pointSlug, config('constants.toastmaster_alias_array')) ?
                config('constants.toastmaster_slug') :
                $pointSlug;

            if (isset($meetingPointSlugs[$pointSlug]) && $userID != "") {
                $scoreDetails = [
                    'user_id'     => $userID,
                    'notes'       => $pointSlug == config('constants.grammarian_slug') ? $input[config('constants.word_of_the_day_slug')] : '',
                    'point_id'    => $meetingPointSlugs[$pointSlug]->id,
                    'point_value' => $meetingPointSlugs[$pointSlug]->point_value,
                ];
                $mergedInput = array_merge($input, $scoreDetails);
                $score = new RecordScore($mergedInput);
                $score->saveScore();
            }
        }
    }

    public function recordMultipleScores($input, $meetingPointSlugs)
    {
        foreach ($input as $pointSlugAlias => $usersID) {
            $input['which_half'] = $pointSlugAlias == "toastmaster_2" ? 2 : $input['which_half'];
            foreach (config('constants.meeting_form_ids_array') as $configPointSlugAlias => $actualPointSlug) {
                if ($pointSlugAlias == $configPointSlugAlias) {
                    $usersIDArray = parseIDString($usersID, "|");
                    // Create a new score for each one
                    foreach ($usersIDArray as $userID) {
                        $scoreDetails = [
                            'user_id'     => $userID,
                            'point_id'    => $meetingPointSlugs[$actualPointSlug]->id,
                            'point_value' => $meetingPointSlugs[$actualPointSlug]->point_value,
                        ];
                        $mergedInput = array_merge($input, $scoreDetails);
                        $score = new RecordScore($mergedInput);
                        $score->saveScore();

                    }
                }
            }
        }
    }

    public function recordSpeechScores($input, $meetingPointSlugs)
    {
        foreach ($input as $pointSlug => $userID) {
            $input['which_half'] = $pointSlug == "toastmaster_2" ? 2 : $input['which_half'];
            if (strpos($pointSlug, "speech_speaker_") !== false && $userID != "") {
                /**
                 * Find the index of the speech, so we can get the title of the speech
                 * the time of the speech and the evaluator
                 */
                $index = substr($pointSlug, - 1);

                $scoreDetails = [
                    'user_id'     => $userID,
                    'point_id'    => $meetingPointSlugs[config('constants.speech_point_slug')]->id,
                    'point_value' => $meetingPointSlugs[config('constants.speech_point_slug')]->point_value,
                    'is_speech' => 1,
                    'speech_title' => $input["speech_title_$index"],
                    'speaking_time' => $input["speech_time_$index"],
                    'evaluator' => $input["speech_evaluator_$index"],
                ];
                $mergedInput = array_merge($input, $scoreDetails);
                $score = new RecordScore($mergedInput);
                $score->saveScore();
            }
        }
    }

    public function recordSpeechEvaluationScores($input, $meetingPointSlugs)
    {
        foreach ($input as $pointSlug => $userID) {
            $input['which_half'] = $pointSlug == "toastmaster_2" ? 2 : $input['which_half'];
            if (strpos($pointSlug, "speech_evaluator_") !== false && $userID != "") {
                $scoreDetails = [
                    'user_id'     => $userID,
                    'point_id'    => $meetingPointSlugs[config('constants.speech_evaluator_point_slug')]->id,
                    'point_value' => $meetingPointSlugs[config('constants.speech_evaluator_point_slug')]->point_value
                ];
                $mergedInput = array_merge($input, $scoreDetails);
                $score = new RecordScore($mergedInput);
                $score->saveScore();
            }
        }
    }
}