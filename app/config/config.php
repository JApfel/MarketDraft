<?php

	return new Phalcon\Config(array(
		'database' => array(
			'adapter'     => 'Mysql',
			'host'        => 'localhost',
			'username'    => 'root',
			'password'    => 'cpassword1',
			'dbname'      => 'marketdraft',
			'charset'  => 'utf8'
		),
		'application' => array(
			'cacheDir' => __DIR__ . '/../../app/cache/',
			'controllersDir' => __DIR__ . '/../../app/controllers/',
			'modelsDir'      => __DIR__ . '/../../app/models/',
			'viewsDir'       => __DIR__ . '/../../app/views/',
			'pluginsDir'     => __DIR__ . '/../../app/plugins/',
			'baseUri' 		=> '/'
		)
	));
?>
c