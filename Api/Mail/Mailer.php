<?php
namespace Api\Mail;

use Api\Controllers\Controllers as Controller;

class Mailer extends Controller
{

    public function send($is_template, $template, $data, $callback)
    {

        $message = new Message($this->phpmail);

        switch( $is_template ) {
            case 1:
                $message->body($this->twig->render($template, $data));
            break;
            case 0:
                $message->body($template);
            break;
        }

        call_user_func($callback, $message);

        if($this->phpmail->send()){
            return 'sent success';
        }

        return 'not sent';
    }

}
