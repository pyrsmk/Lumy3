Lumy 3.0.0
==========

Lumy is just a wrapper that merges [Slim](http://www.slimframework.com) framework and [Chernozem](https://github.com/pyrsmk/Chernozem) container. It simply extends Chernozem and route all method calls to Slim. Please read both documentations to know how to use Lumy.

Simple example
--------------

```php
$app = new Lumy\App();

// Add a Twig service
$app['twig'] = $app->service(function($app) {
  $loader = new Twig_Loader_Filesystem('/path/to/templates');
  $twig = new Twig_Environment($loader, array(
      'cache' => '/path/to/compilation_cache',
  ));
});

// Add a route
$app->get('/hello/{name}', function($request, $response) {
    // Render the template
    $this['twig']->render('index.html', array(
      'the' => 'variables',
      'go' => 'here'
    ));
});

$app->run();
```

License
-------

[MIT](http://dreamysource.mit-license.org).
