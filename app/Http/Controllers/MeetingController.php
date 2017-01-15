<?php

namespace App\Http\Controllers;

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
        $clubs = Club::lists('name', 'id');
        // Get the last meeting
        $previousMeetingID = Meeting::orderby('id', 'desc')->first()->meeting_number;
        $nextMeetingID = $previousMeetingID + 1;
        $users = User::all()->sortBy('full_name')->pluck('full_name', 'id');


        return view('meetings.create', compact('meeting', 'clubs', 'users', 'nextMeetingID'));
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
        $meeting_data = Meeting::create($input);
        $input['meeting_id'] = $meeting_data->id;
        // Set by default the meeting to be in the 1st half
        $input['which_half'] = 1;

        // Record scores for each user's participation in the meeting
        $meeting = new Meeting();
        $meetingComponent = new MeetingComponent($meeting);
        $meetingComponent->createMeetingScores($input);

        return redirect('/');
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
