<?php

namespace Crystoline\CustomMailProvider;



use Crystoline\CustomMailProvider\Interfaces\ICustomMailerResolver;
use Illuminate\Foundation\Application;
use Illuminate\Mail\MailServiceProvider as LaravelMailServiceProvider;
use Illuminate\Mail\TransportManager;
use Swift_Mailer;

class MailServiceProvider extends LaravelMailServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */


    protected function registerIlluminateMailer()
    {

        //$this->app->bind(CustomMailManager::class);
        $this->app->singleton('mail.manager', function(Application  $app) {
            return $app->make(CustomMailManager::class);
        });


    }

}
