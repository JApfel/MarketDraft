<?php

	use Phalcon\Mvc\Controller;
	
	class ErrorsController extends Controller	{
	
		function show404Action()	{
			echo $this->view->render('errors', '404');
		}
	}