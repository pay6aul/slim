<?php
// Routes

$app->get('/category[/[{category_id}]]', function ($request, $response, $args) use ($container) {
    $homes = new Api\Controllers\Categories($container);
    return $homes->get($request, $response, $args);
});

$app->post('/create/category', function ($request, $response, $args) use ($container) {
    $homes = new Api\Controllers\Categories($container);
    return $homes->create($request, $response, $args);
});
