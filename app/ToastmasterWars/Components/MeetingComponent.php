<?php

namespace App\ToastmasterWars\Components;

use App\Models\Point;
use App\ToastmasterWars\Components\PointComponent;
use App\ToastmasterWars\Components\ScoreComponent;

class MeetingComponent
{

    /**
     * Based on input, record the scores for a particular meeting
     * @param $input
     */
    public function createMeetingScores($input)
    {

        // Retrieve all meeting point slugs
        $pointComponent = new PointComponent();
        $meetingPointSlugs = $pointComponent->getMeetingPointSlugs();

        // Record score records across the whole meeting
        $scoreComponent = new ScoreComponent();
        $scoreComponent->recordIndividualScores($input, $meetingPointSlugs);
        $scoreComponent->recordMultipleScores($input, $meetingPointSlugs);
        $scoreComponent->recordSpeechScores($input, $meetingPointSlugs);
        $scoreComponent->recordSpeechEvaluationScores($input, $meetingPointSlugs);

    }
}
