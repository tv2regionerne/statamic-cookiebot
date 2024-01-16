<?php

namespace Tv2regionerne\StatamicCookiebot;

use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $tags = [
        Tags\Cookiebot::class,
    ];

    public function bootAddon()
    {
        //
    }
}
