<?php

use App\Models\Category;
use App\Models\Meeting;
use App\Models\Point;
use App\Models\Score;
use App\Models\User;
use App\ToastmasterWars\Components\CategoryComponent;
use App\ToastmasterWars\Components\MeetingComponent;
use App\ToastmasterWars\Components\ScoreComponent;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MeetingTest extends TestCase
{

    use DatabaseTransactions;

    protected $chairmanID;
    protected $secretaryID;
    protected $sargeantID;
    protected $clubID;
    protected $meeting;
    protected $previousMeetingID;
    protected $attendancePointid;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->clubID = 1;
        $this->attendancePointId = 26;
        $this->chairmanID = User::with('userClubs')
            ->whereHas('userClubs', function($query) {
                $query->where('date_left', null)->where('main_club', 1);
            })
            ->orderBy(DB::raw('RAND()'))
            ->take(1)
            ->get()->first()->id;

        $this->secretaryID = User::with('userClubs')
            ->whereHas('userClubs', function($query) {
                $query->where('date_left', null)->where('main_club', 1);
            })
            ->orderBy(DB::raw('RAND()'))
            ->whereNotIn('id', [$this->chairmanID])
            ->take(1)
            ->get()->first()->id;

        $this->sargeantID = User::with('userClubs')
            ->whereHas('userClubs', function($query) {
                $query->where('date_left', null)->where('main_club', 1);
            })
            ->orderBy(DB::raw('RAND()'))
            ->whereNotIn('id', [$this->chairmanID, $this->secretaryID])
            ->take(1)
            ->get()->first()->id;

        $this->previousMeetingID = Meeting::orderby('id', 'desc')->first()->meeting_number;

        $this->meeting = MeetingComponent::createMeeting([
            'club_id' => $this->clubID,
            'chairman' => $this->chairmanID,
            'serjeant_at_arms' => $this->sargeantID,
            'secretary' => $this->secretaryID,
            'meeting_date' => '2016-12-08',
            'meeting_start_time' => '19:00',
            'meeting_end_time' => '21:00',
        ]);

    }

    /** @test */
    public function create_a_meeting_and_check_it_saved()
    {
        $this->assertInternalType('int', $this->meeting->id);
    }

    /** @test */
    public function check_meeting_number_is_higher_than_previous_meeting()
    {
        $this->assertGreaterThan($this->previousMeetingID, $this->meeting->meeting_number, 'Its not bigger. Meeting id not stored');
    }

    /** @test */
    public function get_cateogories_to_record_scores_for_meetings() {
        $categories = CategoryComponent::getMeetingCategories();
        $this->assertGreaterThan(0, count($categories));
    }

    /** @test */
    public function add_scores_for_meeting_for_category() {
        $usersID = User::orderBy(DB::raw('RAND()'))
            ->take(3)
            ->get()->pluck('id')->toArray();

        $meetingComponent = new MeetingComponent($this->meeting);
        $this->attendancePointid = 26;

        $meetingComponent->saveUsersScore($this->attendancePointid, $usersID);

        $attendanceUsersCount = $meetingComponent->getUsersByCategory($this->attendancePointid);
        $this->assertCount(count($usersID), $attendanceUsersCount);
    }

    /** @test */
    public function edit_scores_for_meeting_for_category() {
        $usersID = User::orderBy(DB::raw('RAND()'))
            ->take(3)
            ->get()->pluck('id')->toArray();

        $otherUser = User::with('userClubs')
            ->whereHas('userClubs', function($query) {
                $query->where('date_left', null)->where('main_club', 1);
            })
            ->orderBy(DB::raw('RAND()'))
            ->whereNotIn('id', $usersID)
            ->take(1)
            ->get()->first()->id;

        $half = 1;
        $this->attendancePointid = 26;
        $meetingComponent = new MeetingComponent($this->meeting);

        $meetingComponent->saveUsersScore($this->attendancePointid, $usersID, $half);

        // Now add another user
        $usersID = array_push($usersID, $otherUser);

        $meetingComponent->saveUsersScore($this->attendancePointid, $otherUser, $half, 'notes notes');

        $attendanceUsersCount = $meetingComponent->getUsersByCategory($this->attendancePointid, $half);

        // Should be 4
        $this->assertCount(4, $attendanceUsersCount);
        //
        //// Check that each user is from the 1st half
        foreach ($attendanceUsersCount as $index => $userScore) {
            $this->assertEquals($userScore['which_half'], $half);
            if ($index == 3) {
                $this->assertEquals($userScore['notes'], 'notes notes', 'The notes arent being copied over');
            }
        }

        // Then remove the first user
        $firstUserScore = $attendanceUsersCount->shift();

        //$scoreComponent->deleteUserScore($firstUserScore['id']);
        //$deletingScore = Score::find($firstUserScore['id']);
        $firstUserScore->delete();

        // Now lets add a user to the second half

        $meetingComponent->saveUsersScore($this->attendancePointid, 1, 2);

        $attendance2ndHalf = $meetingComponent->getUsersByCategory($this->attendancePointid, 2);
        // Check that the 2nd half only contains 1 person
        $this->assertEquals(1, count($attendance2ndHalf));

        //// Get all attendance for both half, don't pass in parameter
        $attendanceTotal = $meetingComponent->getUsersByCategory($this->attendancePointid);
        $this->assertEquals(4, count($attendanceTotal));
    }


    /** @test */
    public function check_score_value_is_the_same() {
        $usersID = User::orderBy(DB::raw('RAND()'))
            ->take(3)
            ->get()->pluck('id')->toArray();

        $pointID = 13;

        $point = Point::find($pointID);

        $meetingComponent = new MeetingComponent($this->meeting);
        $meetingComponent->saveUsersScore($pointID, $usersID, 1);

        $evaluators = $meetingComponent->getUsersByCategory($pointID, 1);

        foreach ($evaluators as $evaluator) {
            $this->assertEquals($point->point_value, $evaluator['point_value']);
        }

    }

    /** @test */
    public function record_multiple_speeches() {

        $meetingComponent = new MeetingComponent($this->meeting);
        $speechPoint = Point::find(6);
        $evaluationPoint = Point::find(13);

        $speechdetails = factory(App\Models\Score::class, 'speech', 2)->make()->toArray();

        foreach ($speechdetails as $index => $speech) {
            $speech['meeting_id'] = $this->meeting->id;
            $speech['point_id'] = 6;
            $speech['point_value'] = $speechPoint->point_value;
            if ($index == 0) {
                $speech['evaluator'] = 1;
            }
            $speechdetails[$index] = $speech;
        }

        $meetingComponent->addSpeeches($speechdetails, 1);

        $speechObject = $meetingComponent->getUsersByCategory(6);

        var_dump($speechObject);
        // Check theres 2 speech
        $this->assertEquals(count($speechObject), 2);

        // Check theres 2 evaluations

        $evauations = $meetingComponent->getUsersByCategory(13);
         $this->assertEquals(2, count($evauations));
        $firstEvaluation = $evauations[0];
        $this->assertEquals(1, $firstEvaluation->user_id);


        $firstSpeech = $speechObject[0];

        // Get random evalutor
        $new_speech_title = 'Ben hur is the greatest flop of all time';
        $firstSpeech->update([
            'speech_title' => $new_speech_title
        ]);

        $this->assertEquals($new_speech_title, $firstSpeech->speech_title);

    }

    /** @test */
    public function get_meeting_scores() {
        $meeting = Meeting::find(21);
        $scores = $meeting->scores();
        $this->assertGreaterThan(0, count($scores));
    }

    //
    //function arrays_are_similar($a, $b) {
    //    // if the indexes don't match, return immediately
    //    if (count(array_diff_assoc($a, $b))) {
    //        return false;
    //    }
    //    // we know that the indexes, but maybe not values, match.
    //    // compare the values between the two arrays
    //    foreach($a as $k => $v) {
    //        if ($v !== $b[$k]) {
    //            return false;
    //        }
    //    }
    //    // we have identical indexes, and no unequal values
    //    return true;
    //}
}
