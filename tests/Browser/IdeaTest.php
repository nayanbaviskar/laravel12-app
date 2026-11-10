<?php

use App\Models\Idea;
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
        ->fill('@new-step', 'Do step 1')
        ->click('@add-new-step')
        ->fill('@new-step', 'Do step 2')
        ->click('@add-new-step')
        ->click('Create')
        ->assertPathIs('/ideas');

    expect($idea = $user->ideas()->first())->toMatchArray([
        'title' => 'Test Idea',
        'description' => 'Some description for test',
        'status' => 'completed',
        'links' => ['https://google.com', 'https://laracasts.com'],
    ]);
    expect($idea->steps)->toHaveCount(2);
});

it('shows the initial title', function (): void {
    $this->actingAs($user = User::factory()->create());
    $idea = Idea::factory()->for($user)->create();
    visit(route('idea.show', $idea))
        ->click('@edit-idea-button')
        ->assertValue('title', $idea->title);
});

it('edit existing idea', function (): void {
    $this->actingAs($user = User::factory()->create());
    $idea = Idea::factory()->for($user)->create();
    visit(route('idea.show', $idea))
        ->click('@edit-idea-button')
        ->fill('title', 'Test Idea')
        ->click('@button-status-completed')
        ->fill('description', 'Some description for test')
        ->fill('@new-link', 'https://google.com')
        ->click('@add-new-link')
        ->fill('@new-step', 'Do step 1')
        ->click('@add-new-step')
        ->click('Update')
        ->assertRoute('idea.show', [$idea]);

    expect($idea = $user->ideas()->first())->toMatchArray([
        'title' => 'Test Idea',
        'description' => 'Some description for test',
        'status' => 'completed',
        'links' => [$idea->links[0], 'https://google.com'],
    ]);
    expect($idea->steps)->toHaveCount(1);
});
