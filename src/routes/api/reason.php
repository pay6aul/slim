<?php
// Routes

$app->get('/reason[/[{callme_id}]]', function ($request, $response, $args) use ($container) {
    $homes = new Api\Controllers\Reasons($container);
    return $homes->get($request, $response, $args);
});

$app->post('/create/reason', function ($request, $response, $args) use ($container) {
    $homes = new Api\Controllers\Reasons($container);
    return $homes->create($request, $response, $args);
});
