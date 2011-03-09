<?php

if(APPLICATION_ENV == "development") {
    $cache = new \Doctrine\Common\Cache\ArrayCache;
} else {
    $cache = new \Doctrine\Common\Cache\ApcCache;
}


$doctrineClassLoader = new Doctrine\Common\ClassLoader('Doctrine');
$doctrineClassLoader->register();

$doctrineClassLoader = new Doctrine\Common\ClassLoader('Symfony', 'Thirdparty/Doctrine');
$doctrineClassLoader->register();

$entitiesClassLoader = new Doctrine\Common\ClassLoader('Frontend', ROOT . '/application/library/Models');
$entitiesClassLoader->register();

$proxiesClassLoader = new Doctrine\Common\ClassLoader('Proxies', ROOT . '/application/library/Proxies');
$proxiesClassLoader->register();


$config = new Doctrine\ORM\Configuration();

$config->setMetadataCacheImpl($cache);

$driverImpl = $config->newDefaultAnnotationDriver(array(ROOT . '/application/library/Models'));
$config->setMetadataDriverImpl($driverImpl);

$yamlDriver = new Doctrine\ORM\Mapping\Driver\YamlDriver(ROOT . '/data/db');
$config->setMetadataDriverImpl($yamlDriver);

$config->setProxyDir(ROOT . 'application/library/Proxies');
$config->setProxyNamespace('Proxies');



if(APPLICATION_ENV == "development") {
    $config->setAutoGenerateProxyClasses(true);
} else {
    $config->setAutoGenerateProxyClasses(false);
}


$connectionOptions = array(
   'driver'   		=> 'pdo_mysql',
   'unix_socket' 	=> '/Applications/MAMP/tmp/mysql/mysql.sock',
   'dbname'   		=> 'AFCMS',
   'host'     		=> 'localhost',
   'user'     		=> 'vistahr',
   'password' 		=> 'vistahr',
);



