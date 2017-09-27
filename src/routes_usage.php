<?php
$app->get('/[{name}]', function ($request, $response, $args) {
	$pg = __DIR__ .'/../themes/'. THE_THEMES .'/pages/'. ((isset($args['name']))? $args['name'] : "contents") .'.php';

	if(file_exists($pg)){
		require $pg ;
	}

    return null ;
});

$app->post('/[{name}]', function ($request, $response, $args) {
	$pg = __DIR__ .'/../themes/'. THE_THEMES .'/pages/'. ((isset($args['name']))? $args['name'] : "contents") .'.php';

	if(file_exists($pg)){
		require $pg ;
	}

    return null ;
});
