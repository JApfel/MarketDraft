<?php

	use Phalcon\Mvc\Controller;
	
	class IndexController extends Controller	{
	
		function indexAction()	{
			echo $this->view->render('index', 'index');
		}
		
		function testAction()	{
			$provider = Providers::findFirst("id = '1'");
			print_r($provider);
		}
		
		function infoAction()	{
			phpinfo();
		}
	}