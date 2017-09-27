<?php
// Routes

$app->get('/call[/[{callme_id}]]', function ($request, $response, $args) use ($container) {
    $homes = new Api\Controllers\Callme($container);
    return $homes->get($request, $response, $args);
});

$app->post('/create/call', function ($request, $response, $args) use ($container) {
    $homes = new Api\Controllers\Callme($container);
    return $homes->create($request, $response, $args);
});
