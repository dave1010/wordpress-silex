<?php

require_once __DIR__.'/../vendor/autoload.php';

require_once __DIR__.'/config.php';

function getWordPressJson($query)
{
    return json_decode(file_get_contents(WORDPRESS_API.$query));
}
