<?php


namespace Crystoline\CustomMailProvider;


use Crystoline\CustomMailProvider\Interfaces\ICustomMailerResolver;
use Illuminate\Foundation\Application;
use Illuminate\Mail\TransportManager;

class CustomMailDriver
{


    /**
     * @param TransportManager $manager
     * @return \Closure
     */
    public function __invoke(TransportManager $manager)
    {
        return function (Application $app) {
            $resolver = $app->make(ICustomMailerResolver::class);
            return $resolver->resolve();
        };
    }
}