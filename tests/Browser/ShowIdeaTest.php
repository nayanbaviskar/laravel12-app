<?php

use App\Models\Idea;
use App\Models\User;

it('requires authentication', function (): void {
    $idea = Idea::factory()->create();
    $this->get(route('idea.show', $idea))->assertRedirectToRoute('login');
});

it('requires authorization', function (): void {
    $user = User::factory()->create();
    $this->actingAs($user);
    $idea = Idea::factory()->create();
    $this->get(route('idea.show', $idea))->assertForbidden();
});
