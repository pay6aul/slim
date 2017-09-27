<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// Twig
$container['twig'] = function ($c) {
    $settings = $c->get('settings');
	return new Twig_Environment( new Twig_Loader_Filesystem( $settings['renderer']['template_path'] ) );
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// -----------------------------------------------------------------------------
// Eloquent factories
// -----------------------------------------------------------------------------

// Using Eloquent

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['mysql']);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function () use ($capsule) {
    return $capsule;
};

$container['Validator'] = function () use ($capsule) {
    return new \Api\Validator\Validator($container);
};

// -----------------------------------------------------------------------------
// PHP Mailer factories
// -----------------------------------------------------------------------------

// Using PHP Mailer
$container['phpmail'] = function ($container) {
    $phpmail = new PHPMailer\PHPMailer\PHPMailer;
    $phpmail->isSMTP();                                      // Set mailer to use SMTP

    $phpmail->Host = 'smtp.gmail.com';  // your email host, to test I use localhost and check emails using test mail server application (catches all  sent mails)
    $phpmail->SMTPAuth = true;                 // I set false for localhost
    $phpmail->SMTPSecure = 'ssl';              // set blank for localhost
    $phpmail->Port = 465;                           // 25 for local host
    $phpmail->Username = 'len6nga@gmail.com';    // I set sender email in my phpmail call
    $phpmail->Password = '0714Ki!!';
    $phpmail->isHTML(true);

    return $phpmail;
};

// -----------------------------------------------------------------------------
// Mailer factories
// -----------------------------------------------------------------------------

$container['mailer'] = function ($container) {
    return new \Api\Mail\Mailer($container);
};
