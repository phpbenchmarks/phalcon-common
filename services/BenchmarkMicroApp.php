<?php
namespace PhpBenchmarksPhalcon\RestApi\services;

use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;

class BenchmarkMicroApp {
	private $app;
	private $di;
	
	public function __construct(){
		$this->di = new FactoryDefault();
		$this->app = new Micro($this->di);
		$this->addRoutes();
	}
	
	protected function addRoutes(){
		$func=function(){
			$this->doStuff();
		};
		$this->app->get("/benchmark/rest", $func);
		for($i=0;$i<500;$i++){
			$this->app->get('/benchmark/test-route-'.$i,$func);
		}
	}
	
	protected function doStuff(){
		echo "Okay";
	}
	
	public function handle(){
		$this->app->handle();
	}
}

