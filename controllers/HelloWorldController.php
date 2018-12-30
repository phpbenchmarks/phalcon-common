<?php
namespace PhpBenchmarksPhalcon\HelloWorld\controllers;
use Phalcon\Mvc\Controller;

class HelloWorldController extends Controller{

    public function indexAction(){
		echo "Hello world !";
    }

}

