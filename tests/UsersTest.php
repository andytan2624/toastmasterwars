<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;


    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    /** @test */
    public function get_list_of_active_users() {

    }
}
