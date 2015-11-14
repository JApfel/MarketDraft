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
	
	$router->add('/signup/attorney',
		array(
		   'controller' => 'auth',
		   'action'     => 'providerSignup'
		)
	);
	
	$router->add('/signup',
		array(
		   'controller' => 'auth',
		   'action'     => 'signup'
		)
	);
	
	$router->add('/forgotPassword',
		array(
		   'controller' => 'auth',
		   'action'     => 'forgotPassword'
		)
	);
	
	$router->add('/resetPassword',
		array(
		   'controller' => 'auth',
		   'action'     => 'resetPassword'
		)
	);
	
	$router->add('/updateStatus',
		array(
		   'controller' => 'auth',
		   'action'     => 'updateStatus'
		)
	);
	
	// admin
	
	$router->add('/admin',
		array(
		   'controller' => 'admin',
		   'action'     => 'index'
		)
	);
	
	// help
	
	$router->add('/about',
		array(
		   'controller' => 'help',
		   'action'     => 'about'
		)
	);
	
	$router->add('/forlawyers',
		array(
		   'controller' => 'help',
		   'action'     => 'forLawyers'
		)
	);
	
	// messages
	
	$router->add('/messages/create',
		array(
		   'controller' => 'messages',
		   'action'     => 'create'
		)
	);
	
	$router->add('/messages',
		array(
		   'controller' => 'messages',
		   'action'     => 'index'
		)
	);
	
	// posts
	
	$router->add('/posts/create',
		array(
		   'controller' => 'posts',
		   'action'     => 'create'
		)
	);
	
	$router->add('/posts/{id}/delete',
		array(
		   'controller' => 'posts',
		   'action'     => 'delete'
		)
	);
	
	// rooms
	
	$router->add('/rooms/create',
		array(
		   'controller' => 'rooms',
		   'action'     => 'create'
		)
	);
	
	$router->add('/rooms/{id}',
		array(
		   'controller' => 'rooms',
		   'action'     => 'show'
		)
	);
	
	// appointments
	
	$router->add('/appointments/create',
		array(
		   'controller' => 'appointments',
		   'action'     => 'create'
		)
	);
	
	// reviews
	
	$router->add('/reviews/create',
		array(
		   'controller' => 'reviews',
		   'action'     => 'create'
		)
	);
	
	// providers
	
	$router->add('/attorneys/{id}/:action',
		array(
		   'controller' => 'providers',
		   'action'     => 2
		)
	);
	
	$router->add('/attorneys/{id}',
		array(
		   'controller' => 'providers',
		   'action'     => 'show'
		)
	);
	
	$router->add('/dashboard/:action',
		array(
		   'controller' => 'providers',
		   'action'     => 1
		)
	);
	
	$router->add('/dashboard',
		array(
		   'controller' => 'providers',
		   'action'     => 'index'
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