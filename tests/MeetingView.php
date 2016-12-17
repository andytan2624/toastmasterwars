<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MeetingsTest extends ApiTester
{

    use DatabaseTransactions;
    /**
     * 1) Get Meeting
     * 2) Check theres data
     * 3) Get meeting data
     * 4) Get list of meeting roles in the order they are done
     * 5) For each one, be able to get who did it in that meeting
     * 6) Any other miscelleanous scores that don't belong in a category goes in the middle
     * 7) if there isn't anyone
     * 7) Convert to json
     * 8) return
     * 9) Check return to call
     */
}