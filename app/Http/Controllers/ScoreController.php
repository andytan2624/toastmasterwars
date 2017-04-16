<?php

namespace App\Http\Controllers;

use App\ToastmasterWars\Transformers\ScoreTransformer;
use App\Models\Score;
use App\Models\User;
use App\Models\Category;
use App\Models\Meeting;
use App\Models\Point;
use App\Models\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Config;

class ScoreController extends Controller
{

    protected $scoreTransformer;

    public function __construct(ScoreTransformer $scoreTransformer)
    {
        $this->scoreTransformer = $scoreTransformer;
    }

    public function index($user_id = null) {
        $scores = $user_id ? User::find($user_id)->scores : Score::all();
        return $this->respond([
            'scores' => $this->scoreTransformer->transformCollection($scores)
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
        $meetings = Meeting::all()->sortByDesc('id')->pluck('full_name', 'id');

        /**
         * If the request is a POST method, then check the dates to pick the scores between those dates
         */
        $start_date = '';
        $end_date = '';
        $meeting_id = '';
        $request->flash();
        if ($request->isMethod('post')) {
            $start_date = $request->input('start_date', '');
            $end_date = $request->input('end_date', '');
            $meeting_id = $request->input('meeting_id', '');
        }

        if ($start_date == '' || $end_date == '') {
            $quarter_dates = getQuarterDates();
            $current_year = date('Y');
            $start_date = $current_year.'-'.$quarter_dates['start_date'];
            $end_date = $current_year.'-'.$quarter_dates['end_date'];
        }

        $users = User::all()->sortBy('full_name')->pluck('full_name', 'id');

        $query = Score::with('meeting')
            ->where('point_value', '!=', 0)
            ->whereHas('meeting', function($query) use ($start_date, $end_date) {
                $query->where('meeting_date', '>=', $start_date." 00:00:00");
                $query->where('meeting_date', '<=', $end_date." 23:59:59");
            });

        if ($meeting_id != '') {
            $query->where('meeting_id', '=', $meeting_id);
        }

        $scores = $query->get();

        $tallyArray = array();
        $currentScores = array();

        foreach ($users as $id => $user) {
            $tallyArray[$id] = 0;
            $currentScores[$id] = array();
        }

        foreach ($scores as $score) {
            $tallyArray[$score->user_id] += $score->point_value;
        }

        foreach ($scores as $score) {
            $currentScores[$score->user_id][] = $score->displayScore();
        }

        arsort($tallyArray);

        return view('scores.dashboard', compact('users', 'tallyArray', 'currentScores', 'meetings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $score = new Score();

        $clubs = Club::pluck('name', 'id');
        $users = User::all()->sortBy('full_name')->pluck('full_name', 'id');
        $points = Point::all()->sortBy('category.name')->pluck('full_name', 'id');
        $meetings = Meeting::all()->sortByDesc('id')->pluck('full_name', 'id');
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
        $input = $request->all();

        $input['evaluator'] = !$input['evaluator'] ? null : $input['evaluator'];
        $input['meeting_id'] = !$input['meeting_id'] ? null : $input['meeting_id'];

        // Get the point value
        $point = Point::find($input['point_id']);

        /**
         * If the point category is the custom, use the point value inputted from the form
         */
        if ($point->category_id = config('constants.categories.custom_point_category_id')) {
            $input['point_value'] = $input['custom_point_value'];
        } else {
            $input['point_value'] = $point->point_value;
        }

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

    /**
     * Function which takes the post parameters of start and end date, and
     */
    public function history()
    {

    }


}
