<?php
namespace PhpBenchmarksPhalcon\RestApi\services;

use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Http\Response;
use Phalcon\Events\Manager as EventsManager;
use PhpBenchmarksPhalcon\RestApi\events\DefineLocaleEventListener;

/**
 * Micro app for Rest-api Phalcon benchmark on phpbenchmarks.com
 * @author jc
 * @version 1.0.0
 */
class BenchmarkMicroApp{
	private $app;
	private $di;
	private $_eventsManager;
	
	public function __construct(){
		$this->di = new FactoryDefault();
		$this->app = new Micro($this->di);
		$this->addRoutes();
		$this->setTranslations();
		$this->addEvents();
	}
	
	/**
	 * Creates 1+500 routes 
	 */
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
	
	/**
	 * Creates and inject the translator in the container 
	 */
	protected function setTranslations(){
		$trans=new Translator("fr_FR", "en");
		$this->di->set('translator', $trans);
	}
	
	/**
	 * Adds DefineLocalEventListener in app eventsManager 
	 */
	protected function addEvents(){
		$this->_eventsManager = new EventsManager();
		$listener = new DefineLocaleEventListener();
		$this->_eventsManager->attach(DefineLocaleEventListener::EVENT_NAME, $listener);
	}
	
	/**
	 * Returns the json response
	 * @return \Phalcon\Http\Response
	 */
	protected function doStuff(){
		$response=new Response();
		$response->setContentType('application/json', 'UTF-8');
		$this->_eventsManager->fire(DefineLocaleEventListener::EVENT_NAME.':onLocaleChange',$this->di->get('translator'));
		$datas=(new Users())->serialize($this->di);
		$response->setJsonContent($datas);
		return $response;
	}
	
	public function handle(){
		$this->app->handle();
	}

}

