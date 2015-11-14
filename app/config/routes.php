<?php
	
	$router = new Phalcon\Mvc\Router(false);
	
	$router->setUriSource(Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);
	
	$router->removeExtraSlashes(true);
	
	// index
	
	$router->add('/',
		array(
		   'controller' => 'index',
		   'action'     => 'index'
		)
	);
	
	// search
	
	$router->add('/search',
		array(
		   'controller' => 'search',
		   'action'     => 'index'
		)
	);
	
	// auth
	
	$router->add('/login',
		array(
		   'controller' => 'auth',
		   'action'     => 'login'
		)
	);
	
	$router->add('/logout',
		array(
		   'controller' => 'auth',
		   'action'     => 'logout'
		)
	);
	
	$router->add('/signup',
		array(
		   'controller' => 'auth',
		   'action'     => 'signup'
		)
	);
	
	// help
	
	$router->add('/about',
		array(
		   'controller' => 'help',
		   'action'     => 'about'
		)
	);
	
	// testing
	
	$router->add('/test',
		array(
		   'controller' => 'index',
		   'action'     => 'test'
		)
	);
	
	$router->add('/info',
		array(
		   'controller' => 'index',
		   'action'     => 'info'
		)
	);
	
	// errors
	
	$router->notFound(
		array(
			"controller" => "errors",
			"action" => "show404"
	));
	
	$router->handle();
	
	return $router;
?>