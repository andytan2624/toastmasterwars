<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTest extends ApiTester
{
    use DatabaseTransactions;

    /**
     * 1) Need to get scores between two certain dates
     * 2) That no score extends beyond that date
     * 2) Check that between two dates, they are valid
     * 3) Be able to get a user for a particular score
     * 4) Check that score is being updated for a user
     * 5) Don't return a user in the end who has no points
     * 6) Check that there is an array of users, with data for each one
     * then check we get the same data from api call
     */

}