<?php

namespace Tv2regionerne\StatamicCookiebot\Tags;

use Statamic\Tags\Tags;
use Tv2regionerne\StatamicCookiebot\Events\CookiebotCookieParsed;

class Cookiebot extends Tags
{
    public function consent()
    {
        $consentCookie = $this->parseCookie();

        if (! $consentCookie) {
            return false;
        }

        $type = $this->params['type'] ?? null;

        $consent = match ($type) {
            'all' => ($consentCookie->necessary && $consentCookie->preferences && $consentCookie->statistics && $consentCookie->marketing),
            'necessary' => $consentCookie->necessary,
            'preferences' => $consentCookie->preferences,
            'statistics' => $consentCookie->statistics,
            'marketing' => $consentCookie->marketing,
            default => false,
        };

        return $consent;
    }

    public function necessary()
    {
        $this->params['type'] = 'necessary';

        return $this->consent();
    }

    public function preferences()
    {
        $this->params['type'] = 'preferences';

        return $this->consent();
    }

    public function statistics()
    {
        $this->params['type'] = 'statistics';

        return $this->consent();
    }

    public function marketing()
    {
        $this->params['type'] = 'marketing';

        return $this->consent();
    }

    public function cookie()
    {
        return $this->parseCookie();
    }

    /**
     * The {{ cookiebot:scripts }} tag.
     *
     * @return string|array
     */
    public function scripts()
    {
        $id = config('statamic-cookiebot.domain_group_id');
        if (! $id) {
            return '<!-- Cookiebot is missing configuration -->';
        }

        /**
         * Exclude the script from this url
         */
        if (in_array($this->context->get('url')->value(), config('statamic-cookiebot.exclude', []))) {
            return '<!-- Cookiebot is excluded from this url -->';
        }

        $attributes = collect(config('statamic-cookiebot.attributes'))->whereNotNull()->transform(function ($attribute, $key) {
            return 'data-'.$key.'="'.$attribute.'"';
        });
        $attributes[] = 'data-cbid="'.$id.'"';

        return '<script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" '.$attributes->implode(' ').' type="text/javascript"></script>';
    }

    public function declaration()
    {
        $id = config('statamic-cookiebot.domain_group_id');
        if (! $id) {
            return false;
        }

        return '<script id="CookieDeclaration" src="https://consent.cookiebot.com/'.$id.'/cd.js" type="text/javascript" async></script>';
    }

    private function parseCookie()
    {


        if (! $consentCookie = $_COOKIE['CookieConsent'] ?? null) {
            return false;
        }

        $valid_php_json = preg_replace('/\s*:\s*([a-zA-Z0-9_]+?)([}\[,])/', ':"$1"$2', preg_replace('/([{\[,])\s*([a-zA-Z0-9_]+?):/', '$1"$2":', str_replace("'", '"', stripslashes($consentCookie))));

        $cookieData = json_decode($valid_php_json);
        CookiebotCookieParsed::dispatch($cookieData);
        return $cookieData;
    }
}
