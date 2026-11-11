<?php

use App\Models\User;
use App\Notifications\EmailChanged;
use Illuminate\Support\Facades\Notification;

it('requires authentication', function () {
    $this->get(route('profile.edit'))->assertRedirect('/login');
});
it('edits the profile', function () {
    $user = User::factory()->create();
    $newEmail = fake()->unique()->safeEmail();
    $this->actingAs($user);
    visit(route('profile.edit'))
        ->assertValue('name', $user->name)
        ->fill('name', 'New name')
        ->assertValue('email', $user->email)
        ->fill('email', $newEmail)
        ->click('Update Account')
        ->assertSee('Profile updated');

    expect($user->fresh())->toMatchArray([
        'name' => 'New name',
        'email' => $newEmail,
    ]);
});

it('notifies the user on mail', function () {
    $user = User::factory()->create();
    $originalEmail = $user->email;
    $newEmail = fake()->unique()->safeEmail();
    $this->actingAs($user);
    Notification::fake();
    visit(route('profile.edit'))
        ->assertValue('email', $user->email)
        ->fill('email', $newEmail)
        ->click('Update Account')
        ->assertSee('Profile updated');

    Notification::assertSentOnDemand(EmailChanged::class, function (EmailChanged $notification, $routes, $notifiable) use ($originalEmail) {
        return $notifiable->routes['mail'] === $originalEmail;
    });
});
