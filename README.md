# Hexavel Framework

[![Join the chat at https://gitter.im/peterfox/hexavel](https://badges.gitter.im/peterfox/hexavel.svg)](https://gitter.im/peterfox/hexavel?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

Hexavel is a restructured version of [Laravel](http://laravel.com), with the purpose of providing better work flows which
will simplify the development process.

### Install

To install via composer simply use the command

```
composer create-project --prefer-dist peterfox/hexavel <name of your project>
```

## What's different from Laravel?

### File structure

Hexavel uses a widely changed filesystem from Laravel with which to produce a working application. Each folder is
explained before so you can understand where to find or place your own work.

#### Binaries (bin)

This is where all our console applications go, including the artisan console and the binaries install via composer.
All of artisan's commands work the same as Laravel except now you must use `bin/artisan` instead from the root directory of your
application.

#### Source (src)

This is where our base PHP application code goes using the default namespace \App.

#### Application (app)

For the moment this simply stores our applications configs and routing files.

#### Support

This is our biggest change from Laravel. Support is how it sounds, a directory for all files that support the 
development of our application. This covers views, assets, language files, tests and migrations by default.

There is also a support packages folder which is the suggested place for local packages you might be developing
or sit as part of your project to be loaded via composer.

#### Variable (var)

Variable directory is effectively our application writable directory. All caches and data written by the application
should be stored under this directory. Examples would be the bootstrap cache, logs or an sqlite database.

### Hexagonal Architecture

[Hexagonal architecture](http://fideloper.com/hexagonal-architecture) is a fancy name for a simple concept, 
you should separate your code into what's your framework, your domain and the connections between services
and or libraries that your application interacts with.

#### Laravel
Code that relates to the core of your application in this case Laravel specific code like
service providers or controllers.

#### Bridge
Code that relates to services or libraries that are used by the application.

#### Domain
Code which is unique to your business requirements and is separate to the bridge and framework.

### Repository Pattern built in

The repository pattern is really important and it's useful when working with the Models you'll create using Eloquent.
To make this easier there's a service provider included which allows you to map your models to repositories and in
turn map repository interfaces from your domain to your model interfaces.

Example Repository:

```php
namespace App\Bridge\Eloquent;

use App\Bridge\Eloquent\Model\User;
use App\Domain\AuthenticatableRepository as AuthenticatableRepositoryInterface;
use Hexavel\Repository\EloquentRepository;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthenticatableRepository extends EloquentRepository implements AuthenticatableRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    /**
     * @param string $email
     * @return Authenticatable
     */
    public function findByAuthIdentifier($email)
    {
        return $this->model->where('email', $email)->first();
    }
}
```

Then add the model and repositories to the service provider.

```php
namespace App\Laravel\Providers;

use App\Bridge\Eloquent\Model\User;
use App\Bridge\Eloquent\AuthenticatableRepository;
use App\Domain\AuthenticatableRepository as AuthenticatableRepositoryInterface;
use Hexavel\Support\Providers\RepositoryProvider as ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * @return string[]
     */
    protected function getModelRepositories()
    {
        return [
            AuthenticatableRepository::class => User::class
        ];
    }

    /**
     * @return string[]
     */
    protected function getRepositories()
    {
        return [
            AuthenticatableRepositoryInterface::class => AuthenticatableRepository::class
        ];
    }
}
```

## Testing

Testing is a huge part of any good application that you're developing. Hexavel includes a simple setup for using
both [Behat](http://docs.behat.org/en/v3.0/) and [PHPSpec](http://phpspec.readthedocs.org/en/latest/) to allow you to 
test both the features and the code you develop.

### Behat

Your feature files can be created under support/features, while the feature context for your test suite is under
support/context. You can run tests via `bin/behat` or by calling `gulp behat`.

To make separating the code easier the set up is ready for using the 
[page pattern](http://capgemini.github.io/bdd/effective-bdd/)
as a way of managing the interactions with your application for testing via Behat. 

### PHPSpec

Class specs are stored in support/spec they can be created simply by using the 
phpspec command `bin/phpspec desc <Namespace\\Class>` and then you can call `bin/phpspec run`
or `gulp phpSpec` to perform the tests.

## Warnings

Not all packages made for Laravel will work out of the box with Hexavel. Most will except if they install code into
your project. Laravel Spark is an example of this when it uses a number of stubs and adds assets etc.

## Other Resources

* [Hexavel Spark](https://github.com/peterfox/hexavel-spark)is a package for making Spark compatible with Hexavel due to 
the install of stubs.
* [Hexavel Components](https://github.com/peterfox/hexavel-components)sits between Laravel Framework 
and Hexavel.
* [Hexavel Behat](https://github.com/peterfox/hexavel-behat)holds the contexts that sets up Behat for Hexavel.