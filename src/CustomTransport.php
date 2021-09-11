<?php


namespace Crystoline\CustomMailProvider\MailServiceProvider;


use Crystoline\CustomMailProvider\Interfaces\ICustomMailerResolver;

class CustomTransport
{

    /**
     * CustomTransport constructor.
     */
    public function __construct(ICustomMailerResolver $mailerResolver)
    {
    }
}