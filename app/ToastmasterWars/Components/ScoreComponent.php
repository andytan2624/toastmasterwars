<?php
namespace App\ToastmasterWars\Components;

use App\Models\Category;
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

    /**
     * Process scores, so that it checks if a category has no scores for either half, it will create empty collections
     * Which will make printing out results on template easier so theres no need to deduce if such values exist
     * @param $scores
     */
    public function processScoreForMeetingView($scores) {

        // Get a list of the meeting categories in the order they were intended to be
        $meetingCategories = Category::where('meeting_order', '!=', '-1')
            ->orderBy('meeting_order')->get()->pluck('id')->toArray();

        // Get a list of the other categories that aren't focused on the meeting. We will keep those scores together
        $otherCategories = Category::where('meeting_order', '=', '-1')
            ->get()->pluck('id')->toArray();


        // Initialise other collction
        $scores['other'] = collect([]);
        if (!$scores->has(1)) {
            $scores[1] = collect([]);
        }

        if (!$scores->has(2)) {
            $scores[2] = collect([]);
        }

        foreach ($scores as $which_half => $half_scores) {
            // Group the half scores by the point type
            $scores[$which_half] = $half_scores->groupBy('point_id');
        }

        // Traverse through each category ID
        foreach ($meetingCategories as $categoryID) {
            if ($scores->has(1) && !$scores[1]->has($categoryID)) {
                $scores[1][$categoryID] = collect([]);
            }
            if ($scores->has(2) && !$scores[2]->has($categoryID)) {
                $scores[2][$categoryID] = collect([]);
            }
        }

        // Pull out the scores that belong to the other categories and put it in its own array
        foreach ($scores as $half => $half_scores) {
            foreach ($half_scores as $category => $category_scores) {
                if (in_array($category, $otherCategories)) {
                    $scores['other'] = $scores['other']->merge($category_scores);
                    $half_scores->pull($category);
                }
            }
        }

        return $scores;

    }


}