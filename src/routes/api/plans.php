<?php
// Routes

$app->get('/plan[/[{plan_id}]]', function ($request, $response, $args) use ($container) {
    $homes = new Api\Controllers\Plan($container);
    return $homes->get($request, $response, $args);
});

$app->post('/create/plan', function ($request, $response, $args) use ($container) {
    $homes = new Api\Controllers\Plan($container);
    return $homes->create($request, $response, $args);
});
