<?php

use App\Models\User;

it('create a new idea', function (): void {
    $this->actingAs($user = User::factory()->create());
    visit('/')
        ->click('@create-idea-button')
        ->fill('title', 'Test Idea')
        ->click('@button-status-completed')
        ->fill('description', 'Some description for test')
        ->fill('@new-link', 'https://google.com')
        ->click('@add-new-link')
        ->fill('@new-link', 'https://laracasts.com')
        ->click('@add-new-link')
        ->click('Create')
        ->assertPathIs('/ideas');

    expect($user->ideas()->first())->toMatchArray([
        'title' => 'Test Idea',
        'description' => 'Some description for test',
        'status' => 'completed',
    ]);
});
