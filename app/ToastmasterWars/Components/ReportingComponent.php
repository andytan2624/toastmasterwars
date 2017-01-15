<?php
namespace App\ToastmasterWars\Components;

use App\Models\Score;

class ReportingComponent {

    /**
     * For a category, return an array of
     * @param $pointId
     */
    public function getPointScores($pointId) {
        $scores = Score::with('meeting', 'user')
            ->where('point_id', $pointId)
            ->get()->toArray();

        return $scores;
    }

    // Comparison function
    function cmp($a, $b) {
        if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? -1 : 1;
    }


    public function getMeetingGraphData($meetings, $scores) {
        // Gather the data, don't parse it yet
        $meetingData = [];

        foreach ($scores as $score) {
            // Check if the meeting hasn't been defined already
            $meeting = $score['meeting'];
            if (!isset($meetingData[$meeting['id']])) {
                $meetingData[$meeting['id']] = [];
            }
            $meetingData[$meeting['id']][] = $meeting;
        }

        // Traverse through each meeting and set count for each meeting
        $finalData = [];
        foreach ($meetings as $meeting) {
            $key = "#".$meeting->meeting_number." (".$meeting->meeting_date.")";
            $finalData[$key] = isset($meetingData[$meeting->id]) ? count($meetingData[$meeting->id]) : 0;
        }

        return $finalData;
    }

    public function getUserGraphData($scores) {
        // Gather the data, don't parse it yet
        $userData = [];

        foreach ($scores as $score) {
            // Check if the user hasn't been defined already
            $user = $score['user'];
            if (!isset($userData[$user['id']])) {
                $userData[$user['id']] = [];
            }
            $userData[$user['id']][] = $user;
        }

        // Now sort the data from highest count to lowest
        $finalData = [];
        foreach ($userData as $userID => $data) {
            $finalData[$userID] = [
                'name' => $data[0]['first_name'].' '.$data[0]['last_name'],
                'count' => count($data)
            ];
        }

        usort($finalData, function($a, $b) {
            return $b['count'] - $a['count'];
        });

        return $finalData;
    }

}