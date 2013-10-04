<?php


require_once __DIR__.'/../app/bootstrap.php';


$app = new Silex\Application();
$app['debug'] = true;

$app->get('/', function() {
    $json = getWordPressJson('?json=1');
    $posts = $json->posts;
    $post = $posts[0];
    return "<h1>$post->title</h1>" .  "<div>$post->content</div>";
});

$app->get('{url}', function($url) {
//    var_dump($url);die();
    $json = getWordPressJson($url.'?json=1');

//var_dump($json);die();
    $post = $json->page;
//    $post = $posts[0];
    return "<h1>$post->title</h1>" .  "<div>$post->content</div>";
});





$app->run();

