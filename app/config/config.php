<?php

return new \Phalcon\Config(array(
	'database' => array(
		'adapter' => 'Mysql',
		'host' => 'localhost',
		'username' => 'radek',
		'password' => '123radek',
		'dbname' => 'phalcon_phaldoc',
		'charset' => 'utf8',
		'collation' => 'utf8_unicode_ci',
	),
	'application' => array(
		'controllersDir' => __DIR__ . '/../../app/controllers/',
		'modelsDir' => __DIR__ . '/../../app/models/',
		'viewsDir' => __DIR__ . '/../../app/views/',
		'cacheDir'       => __DIR__ . '/../../app/cache/',
		'libraryDir' => __DIR__ . '/../../app/library/',
		'docsDir' => '../docs/',
		'baseUri' => '/',
	)
));
