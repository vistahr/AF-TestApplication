<?php
define('APPLICATION_ENV', 'production');

define('ROOT', dirname(dirname(__FILE__)));

// Pfad zum libraryverzeichnis
set_include_path(get_include_path() . PATH_SEPARATOR . 
				 ROOT . '/../AnemoFramework/library/');


require_once 'Application.php';


try {
	$app = new Application();
	$app->run();

} catch(Anemo\Runtime\Exception $e) {
	$app->getFrontcontroller()->getResponse()->setException($e);
	$app->run($app->getFrontcontroller()->initErrorHandling()->dispatch());

} catch(Anemo\Exception $e) {
	echo $e->getMessage();
	echo $e->getTraceAsString();
}