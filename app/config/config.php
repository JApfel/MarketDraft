<?php

	return new Phalcon\Config(array(
		'database' => array(
			'adapter'     => 'Mysql',
			'host'        => 'localhost',
			'username'    => 'root',
			'password'    => 'leo869636',
			'dbname'      => 'lawnearme',
			'charset'  => 'utf8'
		),
		'application' => array(
			'cacheDir' => __DIR__ . '/../../app/cache/',
			'controllersDir' => __DIR__ . '/../../app/controllers/',
			'modelsDir'      => __DIR__ . '/../../app/models/',
			'viewsDir'       => __DIR__ . '/../../app/views/',
			'pluginsDir'     => __DIR__ . '/../../app/plugins/',
			'baseUri' 		=> '/'
		),
		'mail' => array(
			//'defaultAdmin' => 'support@lawnearme.com',
			'defaultAdmin' => 'support@lawnearme.com',
			'fromName' => 'LawNearMe',
			'fromEmail' => 'noreply@lawnearme.com',
			'smtp' => array(
				'server' => 'smtp.mandrillapp.com',
				'port' => '587',
				'username' => 'sams@lawnearme.com',
				'password' => 'iVNiooSstIDojzuOZsDQsQ'
			)
		),
		'maps' => array(
			'api_link' => 'http://www.datasciencetoolkit.org/maps/api/geocode/json?sensor=false&address='
		),
		'stripe' => array(
			'secret_key' => 'sk_test_y0w548fUMS7b0AVaZf8PR4NH',
			'publishable_key' => ''
		),
		'aws' => array(
			'access' => 'AKIAIH5JCNVFG45IBNKQ',
			'secret' => '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',
			'bucket' => 'lawnearmecom',
			'cloudfront' => 'http://d36o5j6e5qmbuy.cloudfront.net'
		)
	));
?>
c