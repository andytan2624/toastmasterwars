<?php
namespace App\ToastmasterWars\Components;

use App\Models\Score;

class ReportingComponent {

    /**
     * For a category, return an array of
     * @param $pointId
     */
    public function getCategoryStatistics($pointId) {
        $pointScores = $this->getPointScores($pointId);
    }

    public function getPointScores($pointId) {
        $scores = Score::with('meeting', 'user')
            ->where('point_id', $pointId)
            ->get()->toArray();
        dd($scores);
    }
}