<?php
namespace PhpBenchmarksPhalcon\RestApi\services;

use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Http\Response;

class BenchmarkMicroApp {
	private $app;
	private $di;
	
	public function __construct(){
		$this->di = new FactoryDefault();
		$this->app = new Micro($this->di);
		$this->addRoutes();
	}
	
	protected function addRoutes(){
		$self=$this;
		$func=function() use($self){
			return $self->doStuff();
		};
		$this->app->get("/benchmark/rest", $func);
		for($i=0;$i<500;$i++){
			$this->app->get('/benchmark/test-route-'.$i,$func);
		}
	}
	
	protected function doStuff(){
		$response=new Response();
		$response->setContentType('application/json', 'UTF-8');
		$datas=(new Users())->serialize();
		$response->setJsonContent($datas);
		return $response;
	}
	
	public function handle(){
		$this->app->handle();
	}
}

