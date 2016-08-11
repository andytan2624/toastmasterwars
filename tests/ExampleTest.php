<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $countries = factory(\App\Models\Country::class)->create();

        $andy = factory('App\Models\User')->create(['email' => 'andy@email.com']);
        $this->actingAs($andy)->visit('/admin')->see('Hello Andy');
    }
}
