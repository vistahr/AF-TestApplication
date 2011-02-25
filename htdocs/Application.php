<?php

require_once 'Anemo/Application.php';

class Application extends Anemo\Application {
	
	
	public function initSession() {
		Anemo\Session::start();
	}
	
	
	public function initACL() {
		$acl = new \Anemo\ACL();
		
		// Groups
		$guest 	= $acl->addSubject(new \Anemo\ACL\Subject('guest'));
		$mod   	= $acl->addSubject(new \Anemo\ACL\Subject('moderator')	, array($guest));
		$mod2	= $acl->addSubject(new \Anemo\ACL\Subject('moderator2')	, array($mod));	
		$admin  = $acl->addSubject(new \Anemo\ACL\Subject('admin') 		, array($mod, $mod2));
		
		// User
		$acl->addSubject(new \Anemo\ACL\Subject('vince'), array($admin));
		
		// Resourcen
		$backend = $acl->addResource(new \Anemo\ACL\Resource('backend'));
		$acl->addResource(new \Anemo\ACL\Resource('search'), array($backend));
		
		// ACL
		$acl->allow($mod, 'backend', array('view','edit','blubb'));
		$acl->deny($mod, 'backend', array('view'));
		
		
		$ID = \Anemo\ID::getInstance();
		$ID->setDefaultSubject($guest);
		
		
		return $acl;
	}
	
	
	public function initTextile() {
		$textile = new Textile();
		return $textile;
	}
	
	
	public function initView() {
		$view = new Smarty();
		$view->template_dir = $this->getResource('frontcontroller')->getModuleDirectory();
		$view->cache_dir 	= ROOT . '/temp/cache';
		$view->compile_dir 	= ROOT . '/temp/templates';
		$view->use_sub_dirs = true;
		return $view;
	}	
	
	
	public function initOrm() {	
		$doctrineClassLoader = new Doctrine\Common\ClassLoader('Doctrine');
		$doctrineClassLoader->register();
		
		$entitiesClassLoader = new Doctrine\Common\ClassLoader('Models', ROOT . 'application/library/Models');
		$entitiesClassLoader->register();
		
		$proxiesClassLoader = new Doctrine\Common\ClassLoader('Proxies', ROOT . 'application/library/Proxies');
		$proxiesClassLoader->register();
		
		
		$config = new Doctrine\ORM\Configuration();
		
		$driverImpl = $config->newDefaultAnnotationDriver(array(ROOT . 'application/library/Models'));
		$config->setMetadataDriverImpl($driverImpl);
		
		$config->setProxyDir(ROOT . 'application/library/Proxies');
		$config->setProxyNamespace('Proxies');
		
		$connectionOptions = array(
		   'driver'   => 'pdo_mysql',
		   'dbname'   => 'doctrine2_test',
		   'host'     => 'localhost',
		   'user'     => 'root',
		   'password' => '',
		);
		
		$em = Doctrine\ORM\EntityManager::create($connectionOptions, $config);
	}
	
	
	public function initMailer() {
		$mail = new PHPMailer();
		return $mail;
	}
	
	
}