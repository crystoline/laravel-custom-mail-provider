<?php


namespace Crystoline\CustomMailProvider;


use Crystoline\CustomMailProvider\Interfaces\ICustomMailerResolver;
use Illuminate\Foundation\Application;
use Illuminate\Mail\MailManager;

class CustomMailManager extends MailManager
{
    /**
     * @var ICustomMailerResolver
     */
    private $resolver;

    /**
     * CustomMailManager constructor.
     */
    public function __construct(Application $app, ICustomMailerResolver $resolver)
    {
        parent::__construct($app);
        $this->resolver = $resolver;
    }

    protected function createCrystolineTransport()
    {
        //$config = $this->app['config']->get('services.custom_mail', []);

        return $this->resolver->resolve();
    }
}
