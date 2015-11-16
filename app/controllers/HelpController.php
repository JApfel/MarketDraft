<?php

	use Phalcon\Mvc\Controller;
	
	class HelpController extends Controller	{
		
		function aboutAction()	{
			echo $this->view->render('help', 'about');
		}
		
		function forLawyersAction()	{
			echo $this->view->render('help', 'forLawyers');
		}
	}