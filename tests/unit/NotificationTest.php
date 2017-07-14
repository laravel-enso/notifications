<?php

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LaravelEnso\Notifications\app\Notifications\TestNotification;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use DatabaseMigrations;

    private $faker;
    private $user;

    protected function setUp()
    {
        parent::setUp();

        // $this->disableExceptionHandling();
        $this->faker = Factory::create();
        $this->user  = User::first();
        $this->actingAs($this->user);
    }

    /** @test */
    public function getUnreadNotifications()
    {
        $notification = new TestNotification($this->faker->sentence);
        $this->user->notify($notification);

        $this->assertEquals(1, $this->user->unreadNotifications->count());
    }

    /** @test */
    public function markAsRead()
    {
        $notification = new TestNotification($this->faker->sentence);
        $this->user->notify($notification);

        $this->user->notifications->first()->markAsRead();

        $this->assertEquals(1, $this->user->notifications->count());
        $this->assertEquals(0, $this->user->unreadNotifications->count());
    }

    /** @test */
    public function markAllAsRead()
    {
        $notification = new TestNotification($this->faker->sentence);
        $this->user->notify($notification);
        $this->user->notifications->markAsRead();

        $this->assertEquals(0, $this->user->unreadNotifications->count());
    }

    /** @test */
    public function clearAllNotifications()
    {
        $notification = new TestNotification($this->faker->sentence);
        $this->user->notify($notification);

        $this->user->notifications()->delete();

        $this->assertEquals(0, $this->user->notifications->count());
    }
}
