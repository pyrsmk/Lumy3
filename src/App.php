<?php

namespace Lumy;

/*
    Lumy application class
*/
class App implements \ArrayAccess {
    
    /*
        Chernozem\Container $container
    */
    protected $container;
    
    /*
        Constructor
        
        Parameters
            array $values
    */
    public function __construct(array $values = []) {
        $this->container = new \Chernozem\Container($values);
        $this->container->register(new DefaultServices());
        $this->container['slim'] = new \Slim\App($this->container);
        $this->container->readonly('slim');
    }
    
    /*
        Call a Slim or a Chernozem method
        
        Parameters
            string $method
            array $arguments
        
        Return
            mixed
    */
    public function __call($method, $arguments) {
        $object = method_exists($this->container['slim'], $method) ? $this->container['slim'] : $this->container;
        return call_user_func_array([$object, $method], $arguments);
    }
    
    /*
        Verify if a value exists
        
        Parameters
            mixed $id
        
        Return
            boolean
    */
    public function offsetExists($id) {
        return $this->container->has($id);
    }
    
    /*
        Get a value
        
        Parameters
            mixed $id
        
        Return
            mixed
    */
    public function offsetGet($id) {
        return $this->container->get($id);
    }
    
    /*
        Set a value
        
        Parameters
            mixed $id
            mixed $value
    */
    public function offsetSet($id, $value) {
        $this->container->set($id, $value);
    }
    
    /*
        Remove a value
        
        Parameters
            mixed $id
    */
    public function offsetUnset($id) {
        $this->container->remove($id);
    }
    
}
