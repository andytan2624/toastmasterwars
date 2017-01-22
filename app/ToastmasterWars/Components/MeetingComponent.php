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
    public function saveUsersScore($pointID, $users, $which_half = 1, $notes = [], $pointValues = [])
    {

        // Get the Point Object
        $point = Point::findOrFail($pointID);

        // If $users is an integer, make it into an integer
        $users = is_int($users) ? [$users] : $users;

        // Do the same for notes, make it into an array of notes
        $notes = is_string($notes) ? [$notes] : $notes;

        // Create a score record for each user
        foreach ($users as $index => $user) {
            // If the user is not a valid integer, don't bother saving/updating record
            if ($user != "") {
                $scoreDetails = [
                    'user_id'     => $user,
                    'club_id'     => $this->meeting->club_id,
                    'meeting_id'  => $this->meeting->id,
                    'point_id'    => $point->id,
                    'which_half'  => $which_half,
                ];

                $score = Score::firstOrCreate($scoreDetails);

                $updatedDetails = [
                    'notes' => $notes[$index],
                    'point_value' => $point->point_value,
                ];
                // Only update the point value if there is a value that exist for that index
                if (isset($pointValues[$index])) {
                    $updatedDetails['point_value'] = $pointValues[$index];
                }

                $score->update($updatedDetails);
            }
        }
    }

    /**
     * Get list of all scores
     * @param $pointID
     * @param $which_half - If this is blank, get all scores
     */
    public function getUsersByCategory($pointID, $sortByHalf = false)
    {
        $scores = Score::with('user', 'speechEvaluator')
            ->where('meeting_id', '=', $this->meeting->id)
            ->where('point_id', $pointID)
            ->get();

        if ($sortByHalf) {
            $scores = $scores->groupBy('which_half');
        }

        return $scores;
    }

    /**
     * Takes an array of speeches and adds it for a meeting
     * @param $speeches
     * @param $which_half
     */
    public function saveSpeechScore($users, $speech_titles, $evaluators, $speaking_times, $which_half) {

        $speechScore = Point::find(config('constants.categories.speech_id'));
        $evaluatorScore = Point::find(config('constants.categories.speech_evaluation_id'));

        // Create a score record for each user
        foreach ($users as $index => $user) {
            // If the user is not a valid integer, don't bother saving/updating record
            if ($user != "") {
                $scoreDetails = [
                    'user_id'     => $user,
                    'club_id'     => $this->meeting->club_id,
                    'meeting_id'  => $this->meeting->id,
                    'point_id'    => $speechScore->id,
                    'point_value' => $speechScore->point_value,
                    'which_half'  => $which_half,
                    'is_speech'   => 1,
                ];

                $score = Score::firstOrCreate($scoreDetails);
                $score->update([
                    'speech_title' => $speech_titles[$index],
                    'evaluator' => $evaluators[$index],
                    'speaking_time' => $speaking_times[$index],
                ]);

                $score->save();

                // Add/Update score for evaluator classes
                $evaluationDetails = [
                    'club_id'     => $this->meeting->club_id,
                    'meeting_id'  => $this->meeting->id,
                    'point_id'    => $evaluatorScore->id,
                    'point_value' => $evaluatorScore->point_value,
                    'which_half'  => $which_half,
                    'evaluated_speech_id'  => $score->id, //The id of the speech for this evaluation
                ];
                $evaluationScore = Score::firstOrNew($evaluationDetails);

                $evaluationScore->user_id = $evaluators[$index];

                $evaluationScore->save();
            }
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

    /**
     * Function that processes the input for scores
     */
}
