<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    //  var_dump($_SESSION);
    return 'Home Page';
});

$pg = __DIR__ .'/routes/api/users.php';
if(file_exists($pg)){
    require $pg;
}

$pg = __DIR__ .'/routes/api/institute.php';
if(file_exists($pg)){
    require $pg;
}

$pg = __DIR__ .'/routes/api/callme.php';
if(file_exists($pg)){
    require $pg;
}

$pg = __DIR__ .'/routes/api/plans.php';
if(file_exists($pg)){
    require $pg;
}

$pg = __DIR__ .'/routes/api/category.php';
if(file_exists($pg)){
    require $pg;
}

$pg = __DIR__ .'/routes/api/reason.php';
if(file_exists($pg)){
    require $pg;
}

$pg = __DIR__ .'/routes/api/locality.php';
if(file_exists($pg)){
    require $pg;
}
