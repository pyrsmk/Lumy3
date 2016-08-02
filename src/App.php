<?php

namespace Lumy;

/*
	Lumy Application
*/
class App extends \Chernozem\Container {
	
	/*
		Constructor
	*/
	public function __construct() {
		$this['slim'] = new \Slim\App();
		$this->readonly('slim');
	}
	
	/*
		Call Slim's method
		
		Parameters
			string $method
			array $arguments
			
		Return
			mixed
	*/
	public function __call($method, $arguments) {
		return call_user_func_array([$this['slim'], $method], $arguments);
	}
	
}