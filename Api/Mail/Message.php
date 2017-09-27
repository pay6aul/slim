<?php

namespace Api\Mail;

class Message
{
    protected $phpmail;

    public function __construct($phpmail)
    {
        $this->phpmail = $phpmail;
    }

    public function to($address)
    {
        $this->phpmail->addAddress($address);
    }

    public function subject($subject)
    {
        $this->phpmail->Subject = $subject;
    }

    public function body($body)
    {
        $this->phpmail->Body = $body;
    }

    public function from($from)     // if you want to add different sender email in phpmail call.
    {
        $this->phpmail->From = $from;
    }

    public function fromName($fromName) // if you want to add different sender name in phpmail call.
    {
        $this->phpmail->FromName = $fromName;
    }
}
