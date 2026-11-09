<?php

use App\Models\User;
use App\Models\Idea;

it("create a new idea", function () {
    $this->actingAs($user = User::factory()->create());
    visit('/')
        ->click('@create-idea-button')
        ->fill('title', 'Test Idea')
        ->click('@button-status-completed')
        ->fill('description', 'Some description for test')
        ->click('Create')
        ->assertPathIs('/ideas');

    expect($user->ideas()->first())->toMatchArray([
        'title' => 'Test Idea',
        'description'=> 'Some description for test',
        'status'=> 'completed',
        ]);
});
