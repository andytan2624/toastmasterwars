<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meeting;
use App\Models\Club;
use App\Models\Score;
use App\Models\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ToastmasterWars\Components\MeetingComponent;
use App\ToastmasterWars\Components\ScoreComponent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get list of all meetings
        $meetings = Meeting::with('club', 'chairmanUser', 'serjeantAtArmsUser', 'secretaryUser')
            ->where('deleted_at', '=', null)
            ->get();

        return view('meetings.index', compact('meetings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meeting = new Meeting;
        $clubs = Club::pluck('name', 'id');
        // Get the last meeting
        $previousMeetingID = Meeting::orderby('id', 'desc')->first()->meeting_number;
        $nextMeetingID = $previousMeetingID + 1;
        $users = User::all()->sortBy('full_name')->pluck('full_name', 'id');


        return view('meetings.create', compact('meeting', 'clubs', 'users', 'nextMeetingID'));
    }

    /**
     * Store a newly created meeting in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $meeting_data = Meeting::create($input);
        $input['meeting_id'] = $meeting_data->id;
        // Set by default the meeting to be in the 1st half
        $input['which_half'] = 1;

        // Record scores for each user's participation in the meeting
        $meeting = new Meeting();
        $meetingComponent = new MeetingComponent($meeting);
        $meetingComponent->createMeetingScores($input);

        return redirect()->route('meetings.edit',[$meeting_data->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Array to house other configurations other parts of the page will need
        $otherDetails = [];

        $meeting = Meeting::findOrFail($id);

        $meetingComponent = new MeetingComponent($meeting);
        $scoreComponent = new ScoreComponent();

        $previousMeetings = Meeting::where('id', '<', $id)->orderBy('meeting_number', 'desc')->limit(3)->get();
        $otherDetails['quorum'] = $meetingComponent->getMeetingQuorum($previousMeetings);

        $scores = Score::with('point', 'point.category', 'user','speechEvaluator')->where('meeting_id', '=', $id)->get()
            ->groupBy('which_half');

        /**
         * Process the scores, and return a multidimensional array which groups it by half id, then by category
         */
        $scores = $scoreComponent->processScoreForMeetingView($scores);

        return view('meetings.show', compact('meeting', 'scores', 'previousMeetings', 'otherDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meeting = Meeting::findOrFail($id);

        $scoreComponent = new ScoreComponent();

        $clubs = Club::pluck('name', 'id');
        $users = User::all()->sortBy('full_name')->pluck('full_name', 'id');
        $nextMeetingID = '';

        $scores = Score::with('point', 'point.category', 'user','speechEvaluator')->where('meeting_id', '=', $id)->get()
            ->groupBy('point_id');

        /**
         * Process the scores, and return a multidimensional array which groups it by category, then half ig
         */
        $scores = $scoreComponent->processScoreForEditingView($scores);

        return view('meetings.edit', compact('meeting', 'clubs', 'users', 'nextMeetingID', 'scores'));
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
        $meeting = Meeting::findOrFail($id);
        $meeting->fill($request->input())->save();
        return redirect()->route('meetings.edit', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Meeting::destroy($id);
        return redirect()->back();
    }

    /**
     * Function that allows a user to edit scores for a particular meeting
     * @param $meetingId
     * @param $categoryId
     */
    public function editScores($meetingId, $categoryId) {
        $meeting = Meeting::findOrFail($meetingId);
        $category = Category::findOrFail($categoryId);

        $meetingComponent = new MeetingComponent($meeting);
        $users = User::all()->sortBy('full_name')->pluck('full_name', 'id');

        // Get scores, and group by both half
        $scores = $meetingComponent->getUsersByCategory($category->id, true);

        return view('meetings.editScores', compact('meeting', 'category', 'scores', 'users', 'editPartial'));
    }

    /**
     * Function that allows updates the scores and users for a certain category for a meeting
     * @param $meetingId
     * @param $categoryId
     */
    public function updateScores(Request $request, $meetingId, $categoryId) {
        $meeting = Meeting::findOrFail($meetingId);
        $meetingComponent = new MeetingComponent($meeting);

        $input = $request->all();

        // For each half, process the scores
        for ($half = 1; $half <= 2; $half++) {
            if ($categoryId == config('constants.categories.speech_id')) {
                $meetingComponent->saveSpeechScore(
                    $input['users'][$half],
                    $input['speech_titles'][$half],
                    $input['evaluators'][$half],
                    $input['speaking_times'][$half],
                    $half
                );
            } else {
                // Only used by custom scores so we can modify the point values if we need to
                $pointValues = isset($input['point_values']) ? $input['point_values'][$half] : [];

                $meetingComponent->saveUsersScore($categoryId, $input['users'][$half], $half, $input['notes'][$half], $pointValues);
            }
        }

        return redirect()->route('meetings.editScores',['meetingId' => $meetingId, 'categoryId' => $categoryId]);

    }

    /**
     * Function that will delete a score for a particular meeting
     * @param $meetingId
     * @param $scoreId
     */
    public function deleteScore($scoreId) {
        // If the score is a speech, we need to delete the evaluation score associated with it
        $score = Score::findOrFail($scoreId);
        if ($score->point_id == config('constants.categories.speech_id')) {
            Score::where('evaluated_speech_id', '=', $score->id)->delete();
        }

        // Then destroy the score itself
        Score::destroy($scoreId);

        return redirect()->back();
    }
}
