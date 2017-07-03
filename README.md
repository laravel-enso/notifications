# Notifications
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/950c5954bb654bb588061a3f793f4697)](https://www.codacy.com/app/laravel-enso/Notifications?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=laravel-enso/Notifications&amp;utm_campaign=Badge_Grade)
[![StyleCI](https://styleci.io/repos/85684795/shield?branch=master)](https://styleci.io/repos/85684795)
[![License](https://poser.pugx.org/laravel-enso/imagetransformer/license)](https://https://packagist.org/packages/laravel-enso/imagetransformer)
[![Total Downloads](https://poser.pugx.org/laravel-enso/notifications/downloads)](https://packagist.org/packages/laravel-enso/notifications)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/notifications/version)](https://packagist.org/packages/laravel-enso/notifications)

Notifications functionality dependency for [Laravel Enso](https://github.com/laravel-enso/Enso)

[![Watch the demo](https://laravel-enso.github.io/notifications/screenshots/Selection_033.png)](https://laravel-enso.github.io/notifications/videos/demo_01.webm)

<sup>click on the photo to view a short demo in compatible browsers</sup>

### Details

- uses [Pusher](https://pusher.com/) and [Laravel's notification infrastructure](https://laravel.com/docs/5.4/broadcasting) to bring minimal-setup notification functionality
- users can also be notified via email
- comes with a VueJS embeddable component that displays notifications
- allows the lazy loading of notifications
- read and unread notifications are visually differentiated and can be manualy/automatically marked as read, as well as cleared 

### Installation Steps

1. Add `LaravelEnso\Notifications\NotificationsServiceProvider::class` to `config/app.php`

2. Run the migrations

3. Publish the component with `artisan vendor:publish --tag=notifications-component`

4. If not registered already, register on [Pusher](https://pusher.com/) and set your credentials in your `.env` file:

    ````
    BROADCAST_DRIVER=pusher
    PUSHER_APP_ID=
    PUSHER_APP_KEY=
    PUSHER_APP_SECRET=
    ````

5. Install the pusher js library `npm install pusher-js`
6. Uncomment the pusher and [Laravel Echo](https://laravel.com/docs/5.4/broadcasting#installing-laravel-echo) related lines in `bootstrap.js`
7. Set your pusher key inside the Echo declaration within `bootstrap.js`
8. Include the vue-component in your `app.js` and compile everything with `gulp` / `npm run dev`
    
### Publishes

- `php artisan vendor:publish --tag=notifications-component` - VueJS component
- `php artisan vendor:publish --tag=enso-update` - a common alias for when wanting to update the VueJS component, 
once a newer version is released

### Contributions

are welcome