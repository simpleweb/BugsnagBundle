SimplewebBugsnagBundle
======================

Symfony2 [bugsnag-php](https://github.com/bugsnag/bugsnag-php) 2.x integration.


Installation Instructions
-------------------------

### Step 1: Download the BugsnagBundle using composer

The best way to install the bundle is by using [Composer](http://getcomposer.org). Execute the following command:

`composer require simpleweb/bugsnag-php-symfony`

### Step 2: Include the bundle in your AppKernel

*app/AppKernel.php*

```php
public function registerBundles()
{
    $bundles = array(
        ...
        new Simpleweb\BugsnagBundle\SimplewebBugsnagBundle()
        ...
    );
}
```

### Step 3: Configuration

*app/config/config.yml*

```yaml
simpleweb_bugsnag:
    # required

    api_key: your api key

    # optional

    app_version: ~ # useful if you version your app
    notify_stages: [ stage, prod ] # default
    proxy:
        host: ~
        port: ~
        user: ~
        password: ~
```

### Step 4 (optional): Reporting errors from custom commands

By default, this bundle does not handle errors and exceptions that are raised from custom commands.

#### Altering the `console` file

*app/console*

Swap:

```php
use Symfony\Bundle\FrameworkBundle\Console\Application;
```
For:

```php
use Simpleweb\BugsnagBundle\Console\Application;
```


License
-------

This bundle is under the MIT license. See the complete license in the bundle:

    Resources/meta/LICENSE


Testing
-------

Included in the bundle is a controller that will allow you to test if your site is hooked up correctly. Just add the following to your routing.yml:

```yml
simpleweb_bugsnag_bundle:
    resource: "@SimplewebBugsnagBundle/Resources/config/routing.yml"
    prefix:   /bugsnag
```

And then afterwards you can access `your.domain/bugsnag/exception` and `your.domain/bugsnag/error` which should then send errors to your configured Bugsnag project.


Contributors
------------

A lot of this code is based on the
[wrep](https://github.com/wrep/bugsnag-php-symfony)
and
[evolution7](https://github.com/evolution7/Evolution7BugsnagBundle)
bundles.

### Why yet another bundle? ###

- I wanted to make a number of non-BC changes
- I wanted some functionality from Evolution7
- I wanted some functionality from Wrep
- I wanted to rip out a lot of stuff from Evolution7 (release stage/class loader)
- I didn't want Evolution7's license (pretty sure it should be Wrep's?)

See also the list of [contributors](https://github.com/simpleweb/BugsnagBundle/contributors).


Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/simpleweb/BugsnagBundle/issues). You're very welcome to submit issues or submit a pull request!
