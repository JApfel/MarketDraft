<?php

	use Phalcon\Mvc\Controller;
	
	class IndexController extends Controller	{
	
		function indexAction()	{
			echo $this->view->render('index', 'index');
		}
		
		function testAction()	{
			
		}
		
		function infoAction()	{
			phpinfo();
		}
	}