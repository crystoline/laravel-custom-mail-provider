<?php

namespace Crystoline\CustomMailProvider\MailServiceProvider;



use Illuminate\Mail\MailServiceProvider as LaravelMailServiceProvider;

class MailServiceProvider extends LaravelMailServiceProvider
{


    public function register()
    {
        if ($this->app['config']['mail.driver'] == 'db') {
            $this->registerCustomeSwiftMailer();
        } else {
            parent::registerSwiftMailer();
        }
    }

    private function registerDBSwiftMailer()
    {
        $this->app['swift.mailer'] = $this->app->share(function ($app) {
            return new \Swift_Mailer(new CustomTransport());
        });
    }
}