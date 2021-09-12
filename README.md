# Laravel Custom Mail Provider
Send email via custom email transport channel

## Installation
```shell
composer require crystoline/laravel-custom-mail-provider
```

## Configuration

### Env
Change MAIL_DRIVER to 'custom-mailer'
```dotenv
MAIL_MAILER=custom-mailer
```

Add the following to config/mail.php
```php
<?php

return [
    'default' => env('MAIL_MAILER', 'smtp'),
    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'auth_mode' => null,
        ],
        #### Add this
        'custom-mailer' => [
            'transport' => 'crystoline'
        ]
        
        ####

        
    ],

    

];

```


### Mail Transport
Create you custom mail transport by extending "Illuminate\Mail\Transport\Transport" 
```php
use Illuminate\Mail\Transport\Transport;

class MyMailTransport extends Transport
{

    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {

        $url = 'https://my.custome.email.service';

        $data = [

            "toAddress" => implode(',', array_keys($message->getTo())),
            "subject" => $message->getSubject(),
            "body" => $message->getBody()
        ];
       #Send mail logic here :)

    }
}
```

### Resolver
Create a MailTransportResolver by implementing "Crystoline\CustomMailProvider\Interfaces\ICustomMailerResolver"

```php
namespace App\Resolvers;

use App\Services\MyCustomMailTransport;
use Crystoline\CustomMailProvider\Interfaces\ICustomMailerResolver;

class MyMailTransportResolver implements ICustomMailerResolver
{

    function resolve(): \Illuminate\Mail\Transport\Transport
    {
        return new MyCustomMailTransport();
        #   You can have multiple mail transport here
        #   swich(condition){
        #   case A: return new MyCustomMailTransport1();
        #   case B: return new MyCustomMailTransport2();
        #   case C:
        #   default:
        #      return new MyCustomMailTransport3();
        #   }
    }
}
```

### Register Your MailTransportResolver in AppServiceProvider


```php

namespace App\Providers;

use App\Resolvers\MyMailTransportResolver;
use Crystoline\CustomMailProvider\Interfaces\ICustomMailerResolver;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ICustomMailerResolver::class, MyMailTransportResolver::class );
    }
}
```

#### You can start sending email now ;}
