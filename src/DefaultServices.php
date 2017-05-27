<?php

namespace Lumy;

/*
    Provider wrapper for Slim\DefaultServicesProvider
*/
class DefaultServices implements \Chernozem\ServiceProviderInterface {
    
    /*
        Register services
        
        Parameters
            Interop\Container\ContainerInterface $container
    */
    public function register(\Interop\Container\ContainerInterface $container) {
        // Set default settings
        $container['settings'] = [
            'httpVersion' => '1.1',
            'responseChunkSize' => 4096,
            'outputBuffering' => 'append',
            'determineRouteBeforeAppMiddleware' => false,
            'displayErrorDetails' => false,
            'addContentLengthHeader' => true,
            'routerCacheFile' => false,
        ];
        // Register default services
        $provider = new \Slim\DefaultServicesProvider();
        $provider->register($container);
        // Set registered closures as services
        foreach($container->toArray() as $id => $value) {
            if(is_object($value) && $value instanceof \Closure) {
                unset($container[$id]);
                $container[$id] = $container->service($value);
            }
        }
    }
    
}
