<?php
use Api\Common\Common as Common;

$app->get('/[{name}]', function ($request, $response, $args) {

	$pg = __DIR__ .'/../themes/'. THE_THEMES .'/index.php';
	if(file_exists($pg)){
		require $pg ;
	}

    return null ;
});

/*
	SAVE THE SESSION
	----------------
*/
function parseRequestData($data)
{
	return [
		'status'    => $data['status'],
		'msg'       => $data['msg'],
		'jwt_token' => $data['data']['jwt_token'],
		'level'     => $data['data']['userGroup'],
		'userId'    => $data['data']['userId'],
		'fname'     => $data['data']['fname'],
		'lname'     => $data['data']['lname'],
		'email'     => $data['data']['email'],
		'mobile'    => $data['data']['mobile'],
		'username'  => $data['data']['username']
	];
}

$authCredentials = parseRequestData($_POST['data']);

$app->post('/auth/redirect', function ($request, $response, $args) use ($authCredentials) {

	if(!isset($_SESSION[APPS_SESSION]['level'])){
	  session_start();
	}

	$_SESSION[APPS_SESSION] = array(
	    'level'     => $authCredentials['level'],
	    'userId'    => $authCredentials['userId'],
	    'jwt_token' => $authCredentials['jwt_token'],
	    'email'     => $authCredentials['email'],
	    'fname'     => $authCredentials['fname'],
	    'mobile'    => $authCredentials['mobile'],
	    'username'  => $authCredentials['username']
	);

    return null ;
});

/*
	SAVE THE SESSION
	----------------
*/

$app->get('/curl/test', function ($request, $response, $args) {

	//	return Common::pesaformat( 5624, '$', 2 );
	/*
	return Common::pgcurl(
			    'http://127.0.0.1/rmp/api/v1/backend/users-ms/jaribio',
			     array(
			        'username' => 'moul.76@gmail.com',
			        'password' => '236ki@@',
			     ),
			    'post'
			);
	*/

	return Common::geTdata ( 'users', 'GET',
						array(
							'offset' => 0,
						)
					);

});
