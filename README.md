# OnnorokomSMS notifications channel for Laravel

[![Latest Stable Version](https://poser.pugx.org/dgvai/laravel-notification-channel-onnorokomsms/v/stable)](https://packagist.org/packages/dgvai/laravel-notification-channel-onnorokomsms)
[![Total Downloads](https://poser.pugx.org/dgvai/laravel-notification-channel-onnorokomsms/downloads)](https://packagist.org/packages/dgvai/laravel-notification-channel-onnorokomsms)
[![Latest Unstable Version](https://poser.pugx.org/dgvai/laravel-notification-channel-onnorokomsms/v/unstable)](https://packagist.org/packages/dgvai/laravel-notification-channel-onnorokomsms)
[![License](https://poser.pugx.org/dgvai/laravel-notification-channel-onnorokomsms/license)](https://packagist.org/packages/dgvai/laravel-notification-channel-onnorokomsms)
[![Monthly Downloads](https://poser.pugx.org/dgvai/laravel-notification-channel-onnorokomsms/d/monthly)](https://packagist.org/packages/dgvai/laravel-notification-channel-onnorokomsms)
[![Daily Downloads](https://poser.pugx.org/dgvai/laravel-notification-channel-onnorokomsms/d/daily)](https://packagist.org/packages/dgvai/laravel-notification-channel-onnorokomsms)
[![composer.lock](https://poser.pugx.org/dgvai/laravel-notification-channel-onnorokomsms/composerlock)](https://packagist.org/packages/dgvai/laravel-notification-channel-onnorokomsms)

This package makes it easy to send sms via [OnnorokomSMS](https://www.onnorokomsms.com) bulk SMS Service (Bangladesh) with Laravel 5.5+, 6.x and 7.x.

## Contents

- [Installation](#installation)
	- [Setting up your OnnorokomSMS in configuration](#setting-up-your-configuration)
- [Usage](#usage)
- [Changelog](#changelog)
- [License](#license)

## Installation

You can install the package via composer:

``` bash
composer require dgvai/laravel-notification-channel-onnorokomsms
```

### Setting up your configuration

Add your OnnorokomSMS Account credentials to your `config/services.php`:

```php
// config/services.php
...
'onnorokomsms' => [
    'username'      =>  env('ONNOROKOMSMS_USERNAME'),       // The username of OnnorokomSMS service
    'password'      =>  env('ONNOROKOMSMS_PASSWORD'),       // The password of OnnorokomSMS service
    'type'          =>  env('ONNOROKOMSMS_TYPE'),           // TEXT or UCS 
    'mask_name'     =>  env('ONNOROKOMSMS_MASK_NAME'),      // optional but not null use ''
    'campaign_name' =>  env('ONNOROKOMSMS_CAMPAIGN_NAME'),  // optional but not null use ''
],
...
```

In order to let your Notification know which phone are you sending to, the channel will look for the `mobile_number` attribute of the Notifiable model (eg. User model). If you want to override this behaviour, add the `routeNotificationForOnnorokomSMS` method to your Notifiable model.

```php
public function routeNotificationForOnnorokomSMS()
{
    return '+1234567890';
}
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

``` php

use DGvai\OnnorokomSMS\OnnorokomSMS;
use DGvai\OnnorokomSMS\OnnorokomSMSChannel;
use Illuminate\Notifications\Notification;

class OrderPlaced extends Notification
{
    public function via($notifiable)
    {
        return [OnnorokomSMSChannel::class];
    }

    public function toOnnorokomSMS($notifiable)
    {
        return new OnnorokomSMS('Your order has been placed!');
    }
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
