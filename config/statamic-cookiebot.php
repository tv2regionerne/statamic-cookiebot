<?php

return [
    'domain_group_id' => env('COOKIEBOT_ID'),
    'auto_mode' => env('COOKIEBOT_AUTO_MODE', true),
    'attributes' => [
        // Overrides the default dialog type with one of the following values:
        //“optin”, “optout”, “optinout”, “leveloptin”, “inlineoptin”, “optionaloptin”
        'type' => 'optin',
        // Overrides the default consent method with one of the following values:
        // “implied”, “strict”
        'level' => null,
        // To force a specific language variant of the consent dialog,
        // set the value of this attribute to a culture neutral ISO 639-1 language code, e.g. “EN” for English.
        // Setting this attribute with a valid language overrides the “Auto-detect user language” setting in the Cookiebot manager.
        'culture' => null,
        // Enables Cookiebot to signal consent to other consent frameworks implemented on a website in addition to the default consent framework in Cookiebot.
        // The value of the attribute must match the shortcode of the external framework.
        // Currently supported third party consent frameworks: Shortcode “IAB”: IAB Europe Transparency & Consent Framework.
        'framework' => null,
        // Defines if Cookiebot should automatically block all cookies until a user has consented, value: “auto”.
        // If not, (value: “none”) cookie-setting scripts should manually be marked up as described in our manual implementation guide.
        // If you omit this attribute, behavior will equal value: “none”.
        'blockingmode' => null,
        // Allows you to disable Google Consent Mode by passing a value of “disabled”.
        'consentmode' => null,
    ],
    /**
     * Add the paths to exclude.
     * The script will not be inserted in these urls and all consent will default to false
     * Make sure that no js is expecting cookiebot in these url's.
     */
    'exclude' => [
        // '/path_to_exclude_cookiebot_from',
    ],
];
