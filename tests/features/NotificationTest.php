<?php

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\Notification;
use LaravelEnso\TestHelper\app\Traits\SignIn;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase, SignIn;

    private $faker;
    private $user;

    protected function setUp()
    {
        parent::setUp();

        // $this->withoutExceptionHandling();
        $this->faker = Factory::create();
        $this->user = User::first();
        $this->signIn($this->user);
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

class TestNotification extends Notification
{
    public function __construct($body)
    {
        $this->body = $body;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'body' => $this->body,
        ];
    }
}
