<?php

require_once __DIR__.'/../app/bootstrap.php';

$app = new Silex\Application();
$app['debug'] = true;

// memcache
$app->register(new SilexMemcache\MemcacheExtension(), array(
    'memcache.library'    => 'memcached',
    'memcache.server' => array(
        array('127.0.0.1', 11211)
    )
));

// twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../app/views',
));

// TODO: Auth/DDOS protection
$app->get('clear-cache', function() use ($app) {
    return $app['memcache']->flush();
});

$app->get('/', function() use ($app) {

    // load post from memcache
    $post = $app['memcache']->get('home');

    if(empty($post)) {
        $json = getWordPressJson('?json=1');
        $posts = $json->posts;
        $post = $posts[0];
        // set post in memcache
        $app['memcache']->set('home', $post);
    }

    $template = $app['twig']->render('master.twig', array(
        'content' => $post->content,
        'title' => $post->title
    ));

    return $template;
});

$app->get('{url}', function($url) use ($app) {

    // load post from memcache
    $post = $app['memcache']->get($url);

    if(empty($post)) {
        $json = getWordPressJson($url.'?json=1');
        $post = $json->page;
        // set post in memcache
        $app['memcache']->set($url, $post);
    }

    $template = $app['twig']->render('master.twig', array(
        'content' => $post->content,
        'title' => $post->title
    ));

    return $template;
});

$app->run();
