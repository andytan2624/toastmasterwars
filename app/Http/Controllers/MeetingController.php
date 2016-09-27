<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Club;
use App\Models\User;
use App\Models\Score;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Request;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $input = Request::all();
        $meeting_data = Meeting::create($input);
        $input['meeting_id'] = $meeting_data->id;

        $score = new Score();
        $score->createMeetingScores($input);

        // Now we've created our meeting, we will pass the input the score controller to handle

        return redirect('meetings/create');
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
