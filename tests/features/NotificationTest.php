<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\Notification;
use LaravelEnso\Users\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed()
            ->actingAs($this->user = User::first());
    }

    #[Test]
    public function can_fetch_notifications_count()
    {
        $this->user->notify(new TestNotification());

        $this->get(route('core.notifications.count'))
            ->assertStatus(200)
            ->assertJson(['count' => 1]);

        $this->assertEquals(1, $this->user->unreadNotifications->count());
    }

    #[Test]
    public function can_fetch_notifications()
    {
        $this->get(route('core.notifications.index', [
            'offset'   => 0,
            'paginate' => 100,
        ]))->assertStatus(200);
    }

    #[Test]
    public function fetches_only_current_user_notifications_with_offset_and_paginate()
    {
        $otherUser = User::factory()->create();

        $this->user->notify(new TestNotification());
        $this->user->notify(new TestNotification());
        $otherUser->notify(new TestNotification());

        $response = $this->get(route('core.notifications.index', [
            'offset' => 1,
            'paginate' => 1,
        ], false))->assertStatus(200);

        $this->assertCount(1, $response->json());
        $this->assertSame(2, $this->user->notifications()->count());
        $this->assertSame(1, $otherUser->notifications()->count());
    }

    #[Test]
    public function can_mark_as_read()
    {
        $this->user->notify(new TestNotification());

        $notification = $this->user->notifications->first();

        $this->patch(
            route('core.notifications.read', [$notification->id], false)
        )->assertStatus(200)
            ->assertJsonFragment([
                'read_at' => $notification->refresh()->read_at->toJson(),
            ]);
    }

    #[Test]
    public function can_mark_all_as_read()
    {
        $this->user->notify(new TestNotification());

        $this->post(route('core.notifications.readAll'))
            ->assertStatus(200);

        $this->assertEquals(0, $this->user->fresh()->unreadNotifications->count());
    }

    #[Test]
    public function can_destroy_notification()
    {
        $this->user->notify(new TestNotification());

        $notification = $this->user->notifications->first();

        $this->delete(
            route('core.notifications.destroy', [$notification->id], false)
        )->assertStatus(200);

        $this->assertEquals(0, $this->user->notifications()->count());
    }

    #[Test]
    public function can_destroy_all_notifications()
    {
        $this->user->notify(new TestNotification());

        $this->delete(route('core.notifications.destroyAll'))
            ->assertStatus(200);

        $this->assertEquals(0, $this->user->notifications()->count());
    }

    #[Test]
    public function cant_mark_another_users_notification_as_read()
    {
        $otherUser = User::factory()->create();
        $otherUser->notify(new TestNotification());

        $notification = $otherUser->notifications->first();

        $this->patch(route('core.notifications.read', [$notification->id], false))
            ->assertStatus(404);

        $this->assertNull($notification->fresh()->read_at);
    }

    #[Test]
    public function cant_destroy_another_users_notification()
    {
        $otherUser = User::factory()->create();
        $otherUser->notify(new TestNotification());

        $notification = $otherUser->notifications->first();

        $this->delete(route('core.notifications.destroy', [$notification->id], false))
            ->assertStatus(404);

        $this->assertSame(1, $otherUser->notifications()->count());
    }

    #[Test]
    public function read_all_only_marks_current_users_notifications()
    {
        $otherUser = User::factory()->create();

        $this->user->notify(new TestNotification());
        $otherUser->notify(new TestNotification());

        $this->post(route('core.notifications.readAll'))
            ->assertStatus(200);

        $this->assertSame(0, $this->user->fresh()->unreadNotifications->count());
        $this->assertSame(1, $otherUser->fresh()->unreadNotifications->count());
    }

    #[Test]
    public function destroy_all_only_removes_current_users_notifications()
    {
        $otherUser = User::factory()->create();

        $this->user->notify(new TestNotification());
        $otherUser->notify(new TestNotification());

        $this->delete(route('core.notifications.destroyAll'))
            ->assertStatus(200);

        $this->assertSame(0, $this->user->notifications()->count());
        $this->assertSame(1, $otherUser->notifications()->count());
    }
}

class TestNotification extends Notification
{
    public function __construct()
    {
        $this->body = 'testing';
    }

    public function via()
    {
        return ['database'];
    }

    public function toArray()
    {
        return [
            'body' => $this->body,
        ];
    }
}
