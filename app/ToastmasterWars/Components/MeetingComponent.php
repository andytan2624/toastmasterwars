<?php

namespace App\ToastmasterWars\Components;

use App\Models\Meeting;
use App\Models\Point;
use App\Models\Score;
use App\ToastmasterWars\Components\PointComponent;
use App\ToastmasterWars\Components\ScoreComponent;

class MeetingComponent
{

    public $meeting;

    public function __construct(Meeting $meeting)
    {
        $this->meeting = $meeting;
    }

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

    /**
     * Based on input, create the meeting object and return it. Return false if they don't provide everything we need
     * @param $input
     */
    public static function createMeeting($input)
    {

        $previousMeetingID = Meeting::orderby('id', 'desc')->first()->meeting_number;
        $input['meeting_number'] = $previousMeetingID + 1;
        $meeting = Meeting::create($input);

        return $meeting;
    }

    /**
     * Record all the users in $users for a specific point and
     * @param $pointID
     * @param $users - Can be array or integer
     */
    public function saveUsersScore($pointID, $users, $which_half = 1, $notes = '')
    {

        // Get the Point Object
        $point = Point::findOrFail($pointID);

        // If $users is an integer, make it into an integer
        $users = is_int($users) ? [$users] : $users;

        // Create a score record for each user
        foreach ($users as $user) {
            $scoreInput = [
                'user_id'     => $user,
                'club_id'     => $this->meeting->club_id,
                'meeting_id'  => $this->meeting->id,
                'point_id'    => $point->id,
                'point_value' => $point->point_value,
                'which_half'  => $which_half,
                'notes'       => $notes,
            ];

            Score::create($scoreInput);
        }
    }

    /**
     * Get list of all scores
     * @param $pointID
     * @param $which_half - If this is blank, get all scores
     */
    public function getUsersByCategory($pointID, $which_half = '')
    {
        $scoreQuery = Score::with('user', 'speechEvaluator')
            ->where('meeting_id', '=', $this->meeting->id)
            ->where('point_id', $pointID)
            ;

        if ($which_half != '') {
            $scoreQuery = $scoreQuery->where('which_half', $which_half);
        }

        $scores = $scoreQuery
            ->get();

        return $scores;
    }

    /**
     * Takes an array of speeches and adds it for a meeting
     * @param $speeches
     * @param $which_half
     */
    public function addSpeeches($speeches, $which_half) {

        $evaluatorScore = Point::find(config('constants.categories.speech_evaluation_id'));

        // Go through each speech and record the speech record. Also create the
        // score evaluation record
        foreach ($speeches as $speech) {
            $speech['meeting_id'] = $this->meeting->id;
            $speech['$which_half'] = $which_half;
            Score::create($speech);


            $evaluatorInput = [
                'user_id' => $speech['evaluator'],
                'club_id' => $speech['club_id'],
                'meeting_id' => $this->meeting->id,
                'point_id' => $evaluatorScore->id,
                'point_value' => $evaluatorScore->point_value,
                'which_half' => $which_half
            ];

            Score::create($evaluatorInput);

        }
    }

    /**
     * Get the quorum for the current meeting based on the last three previous meetings
     * @param $previousMeetings
     */
    public function getMeetingQuorum($previousMeetings) {
        $meetingAttendanceArray = [];
        $totalAttendance = 0;

        foreach ($previousMeetings as $meeting) {
            $attendance = $meeting->getAttendanceScores();
            $meetingAttendanceArray[] = $attendance;
            $totalAttendance += $attendance;
        }
        $quorum = round((($totalAttendance / 3) * 0.5 ) + 1 , 1);

        return "[{(" . implode(' + ', $meetingAttendanceArray) . ")/3} * 50% + 1] = $quorum";
    }
}
