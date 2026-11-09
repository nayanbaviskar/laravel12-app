<?php

it('registers a user', function (): void {
    visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'johndoe@example.com')
        ->fill('password', 'Password123')
        ->click('Create Account')
        ->assertPathIs('/ideas');

    $this->assertAuthenticated();
    expect(Auth::user())->toMatchArray([
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
    ]);
});

it('requires a valid email', function (): void {
    visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'johndoe123')
        ->fill('password', 'Password123')
        ->click('Create Account')
        ->assertPathIs('/register');
});
