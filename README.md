# Statamic Cookiebot

> Statamic Cookiebot is a Statamic addon that integrates with CookieBot.

## Features

Please see the cookiebot documentation for the js properties, methods and events 
https://www.cookiebot.com/da/developer/

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

``` bash
composer require tv2regionerne/statamic-cookiebot
```

Set the ENV COOKIEBOT_ID with the Domain Group ID.  
This is found in your cookiebot account under Your Scripts section.
```dotenv
COOKIEBOT_ID=4cdc3711-42e3-45f8-8143-70964c23343c
```

You may publish the config and overwrite the attributes of the tag.
See the `config/statamic-cookiebot.php` files.

```bash
php artisan vendor:publish --tag=statamic-cookiebot-config
```

## How to Use

Add this antlers tag to the header of your template to add the cookiebot js code.  
```html
<head>
  {{ cookiebot:scripts }}
</head>
```
The tag will output a html tag like this if the `COOKIEBOT_ID` env has been configured.
```html
<script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="00000000-0000-0000-0000-000000000000">
```

### Client side
A javascript API is available directly from Cookiebot.  
See the js documentation at https://www.cookiebot.com/en/developer/ 

### Server side 

For server side checking of consent, use one of the below tags.  
The tags will return a boolean.
```
{{ cookiebot:necessary }}
{{ cookiebot:preferences }}
{{ cookiebot:statistics }}
{{ cookiebot:marketing }}
{{ cookiebot:all }}
```
To wrap some code use it like this.  
Check for consent on `necessary`.
```
{{ if {cookiebot:necessary} }}
    // code when consent is given
{{ else }}
    // code when no consent is given
{{ /if }}
```

Tag options are:
