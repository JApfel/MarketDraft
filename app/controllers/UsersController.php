<?php

	use Phalcon\Mvc\Controller;
	
	class UserController extends Controller	{
	
		function indexAction()	{
			echo $this->view->render('users', 'index');
		}
	}