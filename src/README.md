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

$app->get('/read/excel[/[{name}]]', function ($request, $response, $args, $result = null) {

	$objPHPExcel	= PHPExcel_IOFactory::load( __DIR__ .'/../tests/sample.xlsx' );

	$objWorksheet	= $objPHPExcel->getActiveSheet();
	$highestRow		= $objWorksheet->getHighestRow();
	$highestCol		= 2;

	for ($row = 1; $row <= $highestRow; ++$row) {

		$data = null;
		for ($col = 0; $col < $highestCol; ++$col) {
			$data[] = $objWorksheet->getCellByColumnAndRow($col, $row);
		}

		$result[] = $data ;
	}

    return json_encode($result);
});

use \Firebase\JWT\JWT;

$app->get('/howto/use/token', function($request, $response, $args) {

    $now_seconds = time();

    $token = [
        "iss" => "https://www.mrlenga.com",
        "sub" => "https://www.mrlenga.com",
        "aud" => "https://identitytoolkit.googleapis.com/google.identity.identitytoolkit.v1.IdentityToolkit",
        "iat" => $now_seconds,
        "exp" => $now_seconds * 1 + 3600,
        "data" => [
            'userId' => 23,
        ]
    ];

    if(!isset($_SESSION)){
        session_start();
    }

    $jwt[] = $_SESSION['tokens'] = JWT::encode($token, JWT_SECRET, 'HS256');

    try{
        $jwt[] = JWT::decode( $_SESSION['tokens'], JWT_SECRET, array('HS256'));
        return   json_encode( $jwt );
    }catch ( \Firebase\JWT\ExpiredException $e ) {
        return 'Sorry, Token Expired';
    }catch ( \Exception $e ){
        return null;
    }

    return null;
});

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

$app->get('/howto/sendmail', function($request, $response, $args) {
	//  command to send the mail
	$data = [
		'fname' => 'Client',
		'pg_titles' => 'Mrlenga Insurance Board',
		'url_activation' => RMP_FRONTEND .'?bef=usajiri/user_activator&q=',
		'contact_us' => OUR_MOBILE,
	];

	$send_status = $this->mailer->send(1, 'mail/template/airmail/welcome.html', $data, function($message) use( $data ) {

		$recipients = array(
           'moul.76@gmail.com' => 'Brian Paul',
		   'echikoka@gmail.com' => 'Elizabeth Chikoka',
           'info@mrlenga.com' => 'Lenga Maige'
        );

        foreach($recipients as $email => $name)
        {
			$message->to($email);
        }

		$message->subject("The PHPMailer");
		$message->from(OUR_EMAIL);
		$message->fromName("Mrlenga");
	});

	//  return response
	return json_encode([
		'status' => 'success',
		'msg' => 'Thanks for join us, your account have been created successfull now to activate open your E-mail!',
		'response' => $data,
		'mail_status' => $send_status
	]);
});

$app->get('/use/template', function($request, $response, $args) {
	return $this->twig->render( 'usilie.phtml', ['name' => 'paul', 'age' => 25]);
});
