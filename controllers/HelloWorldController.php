<?php
namespace PhpBenchmarksPhalcon\HelloWorld\controllers;
use Phalcon\Mvc\Controller;

class HelloworldController extends Controller{

    public function indexAction(){
		echo "Hello world !";
    }

}

