<?php
// Routes

$app->get('/country[/[{state}]]', function ($request, $response, $args) use ($container) {
    return Api\Controllers\Locality::country($request, $response, $args);
});

$app->get('/tanzania', function ($request, $response, $args) use ($container) {
    return Api\Controllers\Locality::tanzania($request, $response, $args);
});

$app->get('/region[/[{inchi}]]', function ($request, $response, $args) use ($container) {
    return Api\Controllers\Locality::region($request, $response, $args);
});

$app->get('/district[/[{mkoa}]]', function ($request, $response, $args) use ($container) {
    return Api\Controllers\Locality::district($request, $response, $args);
});

$app->get('/wards[/[{wilaya}]]', function ($request, $response, $args) use ($container) {
    return Api\Controllers\Locality::wards($request, $response, $args);
});
