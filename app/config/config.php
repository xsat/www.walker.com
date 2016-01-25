<?php

return new \Phalcon\Config([
	'database' => [
		'adapter'     => 'Mysql',
		'host'        => 'localhost',
		'username'    => 'root',
		'password'    => '',
		'dbname'      => 'walker',
	],
	'application' => [
		'controllersDir' => __DIR__ . '/../../app/controllers/',
		'modelsDir'      => __DIR__ . '/../../app/models/',
		'viewsDir'       => __DIR__ . '/../../app/views/',
		'pluginsDir'     => __DIR__ . '/../../app/plugins/',
		'elementsDir'    => __DIR__ . '/../../app/elements/',
		'formsDir'       => __DIR__ . '/../../app/forms/',
		'libraryDir'     => __DIR__ . '/../../app/library/',
		'cacheDir'       => __DIR__ . '/../../app/cache/',
		'baseUri'        => '/',
	],
	'content' => [
		'dir'  => __DIR__ . '/../../public/content/',
		'name' => 'content',
	]
]);
