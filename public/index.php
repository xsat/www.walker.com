<?php

error_reporting(E_ALL);

//define('ST_T', microtime());

try {
	include_once __DIR__ . "/../app/loader/MainApplication.php";
	$application = new MainApplication();
	$application->main();
} catch (Phalcon\Exception $e) {
	echo
	'<pre>',
		preg_replace([
			'#\: (.*)\n#isU',
			'#(\#[0-9]+) #is',
		], [
			': <b style="color: green">$1</b>' . "\n",
			'<b style="color: #03A9F4">$1</b> ',
		], $e->getTraceAsString()), "\n",
		'<b style="color: red">Line</b>: ', $e->getLine(), "\n",
		'<b style="color: red">File</b>: ', $e->getFile(), "\n",
		'<b style="color: red">', get_class($e), '</b>', ": ", $e->getMessage(), "\n",
	'</pre>';
} catch (PDOException $e){
	echo $e->getMessage();
}

//printf('Page loaded %.5f', microtime()-ST_T);