<?php
 
        use Phalcon\Mvc\Url as UrlResolver;
        use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
 
        $di = new Phalcon\DI\FactoryDefault;
       
        $di->set('config', $config);
		
		$di->set('db', function () use ($config) {
		
			$connection = new Phalcon\Db\Adapter\Pdo\Mysql($config->database->toArray());
			
			return $connection;
		});
       
        $di->set('view', function () use ($config) {
 
                $view = new Phalcon\Mvc\View;
 
                $view->setViewsDir($config->application->viewsDir);
 
                $view->registerEngines(array(
                                '.volt' => function ($view, $di) use ($config) {
 
                                        $volt = new Phalcon\Mvc\View\Engine\Volt($view, $di);
 
                                        $volt->setOptions(array(
                                                'compiledPath' => $config->application->cacheDir,
                                                'compiledSeparator' => '_'
                                        ));
 
                                        return $volt;
                                },
                                '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
                        ));
 
                        return $view;
        }, true);
       
        $di->set('router', function () {
                return require __DIR__ . '/routes.php';
        });
		
		$di->set('session', function () {
			$session = new Phalcon\Session\Adapter\Files;
			$session->start();
			return $session;
		}, true);
?>