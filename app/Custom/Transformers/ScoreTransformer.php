<?php

namespace App\Custom\Transformers;

use App\Models\Meeting;
use App\Models\Point;
use App\Models\User;

class ScoreTransformer extends Transformer {

    public function transform($score) {

        $meeting = Meeting::find($score['meeting_id']);

        return [
            'id' => $score['id'],
            'user_id' => User::find($score['user_id'])->full_name,
            'category' => Point::find($score['point_id'])->category->name,
            'score' => $score['point_value'],
            'meeting_number' => $meeting ? $meeting->meeting_number : 'N/A',
            'date_created' => $meeting ? $meeting->meeting_date : $score['created_at'],
        ];
    }
}