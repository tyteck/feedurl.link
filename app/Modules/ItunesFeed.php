<?php

namespace App\Modules;

use InvalidArgumentException;

class ItunesFeed
{
    public const DOMAIN = 'podcasts.apple.com';

    public static function getFeedFrom(string $url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL)===false) {
            throw new InvalidArgumentException("This url {$url} is not valid.");
        }

        $parsedUrl = parse_url($url);
        if ($parsedUrl['host']!==self::DOMAIN) {
            throw new InvalidArgumentException("This url {$url} is not a itunes feed url.");
        }
        

        if (!preg_match('#^.*/id(?<id>[0-9]*$)#', $parsedUrl['path'], $matches)) {
            throw new InvalidArgumentException("This url {$url} is not a complete itunes feed url.");
        }
        
        return json_decode(file_get_contents("https://itunes.apple.com/lookup?id={$matches['id']}&entity=podcast"), true)['results'][0]['feedUrl'];
    }
}
