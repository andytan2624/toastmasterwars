<?php
namespace App\Models\Scores;

use App\Models\Score;
use Auth;

class RecordScore
{

    public $score;

    /*
     * Pass in input of data, which will in data fields in Score model that can be filled
     */
    public function __construct($input)
    {
        $this->score = new Score($input);
        $this->score->created_by = Auth::user()->id;
    }

    public function saveScore()
    {

        // TODO: Find validation rules, check if this is able to save successful
        if (isset($this->score->point_id) && $this->score->point_id > 0) {
            return $this->score->save();
        }

        return false;
    }

}