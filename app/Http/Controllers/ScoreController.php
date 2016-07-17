<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\User;
use App\Models\Category;
use App\Models\Meeting;
use App\Models\Point;
use App\Models\Club;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Request;
use DB;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all()->sortBy('full_name')->pluck('full_name', 'id');

        $scores = Score::all();

        $tallyArray = array();
        $currentScores = array();

        foreach ($users as $id => $user) {
            $tallyArray[$id] = 0;
            $currentScores[$id] = array();
        }

        foreach ($scores as $score) {
            $tallyArray[$score->user_id] += $score->point_value;
        }

        $latestMeeting = Meeting::all()->last();
        $latestScores = Score::where('meeting_id', $latestMeeting->id)->get();
        foreach ($latestScores as $latestScore) {
            $currentScores[$latestScore->user_id][] = $latestScore->point->category->name . ' : ' . $latestScore->point_value . ' points';
        }

        arsort($tallyArray);

        return view('scores.index', compact('users', 'tallyArray', 'currentScores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $score = new Score();

        $clubs = Club::lists('name', 'id');
        $users = User::all()->pluck('full_name', 'id');
        $points = Point::all()->sortBy('category.name')->pluck('full_name', 'id');
        $meetings = Meeting::all()->pluck('full_name', 'id');
        return view('scores.create', compact('score', 'clubs', 'users', 'points', 'meetings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = Request::all();

        $input['evaluator'] = !$input['evaluator'] ? null : $input['evaluator'];
        $input['meeting_id'] = !$input['meeting_id'] ? null : $input['meeting_id'];

        // Get the point value
        $point = Point::find($input['point_id']);
        $input['point_value'] = $point->point_value;

        Score::create($input);

        return redirect('scores/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
