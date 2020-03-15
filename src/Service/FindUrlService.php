<?php

namespace App\Service;

class FindUrlService
{

    public function findUrl()
    {
        $url = null;
        if (isset($_SERVER["REQUEST_URI"])) {
            $uri = $_SERVER["REQUEST_URI"];
            $url = parse_url($uri, PHP_URL_PATH);
        }

        return $url;
    }
}
