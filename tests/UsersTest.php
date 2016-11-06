<?php

use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTest extends ApiTester {

    use DatabaseTransactions;

    /** @test */
    public function it_fetches_users() {
        $this->make('User');

        $this->getJson('api/v1/users');

        $this->assertResponseOk();
    }

    /** @test */
    public function it_fetches_a_single_lesson() {
        $this->make('User');
        $user = $this->getJson('api/v1/users/1')->data;

        $this->assertResponseOk();
        $this->assertObjectHasAttributes($user, 'first_name', 'last_name');
    }

    ///** @test */
    //public function it_creates_a_new_user_given_valid_parameters() {
    //    $this->getJson('api/v1/users', 'POST', $this->getStub());
    //
    //    $this->assertResponseStatus(201);
    //}
    //
    ///** @test */
    //public function it_throws_a_422_if_a_new_lesson_request_fails_validation() {
    //    $this->getJson('api/v1/users', 'POST');
    //
    //    $this->assertResponseStatus(422);
    //}

    protected function getStub()
    {
        return [
            'first_name' => $this->fake->firstName,
            'last_name' => $this->fake->lastName,
            'email' => $this->fake->email,
            'is_admin' => $this->fake->boolean()
        ];
    }

}