<?php

namespace Crystoline\CustomMailProvider;



use Crystoline\CustomMailProvider\Interfaces\ICustomMailerResolver;
use Illuminate\Foundation\Application;
use Illuminate\Mail\MailServiceProvider as LaravelMailServiceProvider;
use Illuminate\Mail\TransportManager;
use Swift_Mailer;

class MailServiceProvider extends LaravelMailServiceProvider
{

    protected function registerIlluminateMailer()
    {
        parent::registerIlluminateMailer();
        $this->app->extend('swift.transport', function (TransportManager $transport) {
            $driver = 'custom-mailer';
            $callback = new CustomMailDriver();
            $transport->extend($driver, $callback($transport));
            return $transport;
        });
    }


}