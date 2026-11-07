<?php

use App\Models\User;

it('login a user', function (): void {
    $user = User::factory()->create(['password' => 'Password123']);
    visit('/login')
        ->fill('email', $user->email)
        ->fill('password', 'Password123')
        ->click('@login-button')
        ->assertPathIs('/');

    $this->assertAuthenticated();
});

it('logout a user', function (): void {
    $user = User::factory()->create();
    $this->actingAs($user);

    visit('/')->click('Logout');
    $this->assertGuest();
});
