Lumy 3.2.0
==========

Lumy is just a wrapper that merges [Slim](http://www.slimframework.com) framework and [Chernozem](https://github.com/pyrsmk/Chernozem) container. Please read both documentations to know how to use Lumy.

Simple example
--------------

```php
$app = new Lumy\App();

// Add a service
$app['twig'] = $app->service(function($app) {
    $loader = new Twig_Loader_Filesystem('/path/to/templates');
    $twig = new Twig_Environment($loader, [
        'cache' => '/path/to/compilation_cache',
    ]);
});

// Add a route
$app->get('/', function($request, $response) {
    // Render the template
    $this['twig']->render('index.html', [
      'the' => 'variables',
      'go' => 'here'
    ]);
});

$app->run();
```

License
-------

[MIT](http://dreamysource.mit-license.org).
