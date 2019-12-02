# Mothership PHP Logs


## Install through composer

```sh
composer require mothership-app/php-logs
```

## General PHP

```php
use Mothership\Logger;

Logger::init([
    'access_token' => 'XXXXXXXXX - YOUR KEY - XXXXXXXX',
    'environment'  => 'production'
]);
Logger::error($exception);
```

## Laravel

```php app/Exceptions/Handler.php
use Illuminate\Support\Facades\App;
use Mothership\Logger;
...

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($this->shouldReport($exception))
        {
            Logger::init([
                'access_token' => 'XXXXXXXXX - YOUR KEY - XXXXXXXX',
                'environment'  => App::environment()
            ]);
            Logger::error($exception);
        }

        parent::report($exception);
    }

```
