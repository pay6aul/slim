<?php
// Routes

$app->get('/users[/[{user_id}]]', function ($request, $response, $args) use ($container) {
    $homes = new Api\Controllers\Users($container);
    return $homes->get($request, $response, $args);
});

$app->post('/create/user', function ($request, $response, $args) use ($container) {
    $homes = new Api\Controllers\Users($container);
    return $homes->create($request, $response, $args);
});

$app->post('/update/user', function ($request, $response, $args) use ($container) {
    $homes = new Api\Controllers\Users($container);
    return $homes->create($request, $response, $args);
});

$app->post('/delete/user', function ($request, $response, $args) use ($container) {
    $homes = new Api\Controllers\Users($container);
    return $homes->create($request, $response, $args);
});

$app->post('/auth/login', function ($request, $response, $args) use ($container) {
    $auths = new Api\Controllers\UserAuthenticationAcceptor();
    return $auths->signIn($request, $response);
});

$app->post('/auth/logout', function ($request, $response, $args) use ($container) {
    $auths = new Api\Controllers\UserAuthenticationAcceptor();
    return $auths->logout($request, $response);
});

$app->post('/change/password', function ($request, $response) use ($container) {
    $homes = new Api\Controllers\Users($container);
    return $homes->changepwd($request, $response, $args);
})->add($mdw);
