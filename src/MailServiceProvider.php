<?php

namespace Crystoline\CustomMailProvider;



use Crystoline\CustomMailProvider\Interfaces\ICustomMailerResolver;
use Illuminate\Foundation\Application;
use Illuminate\Mail\MailServiceProvider as LaravelMailServiceProvider;
use Illuminate\Mail\TransportManager;
use Swift_Mailer;

class MailServiceProvider extends LaravelMailServiceProvider
{


    public function register()
    {
        parent::register();
        if ($this->app['config']['mail.driver'] == 'custom-mailer') {
            $this->registerCustomSwiftMailer();
        }
    }

    private function registerCustomSwiftMailer()
    {



        $this->app->extend('swift.transport', function (TransportManager $transport) {
            $driver = 'custom-mailer';
            $callback = new CustomMailDriver();
            $transport->extend($driver, $callback($transport));
            return $transport;
        });




    }
}