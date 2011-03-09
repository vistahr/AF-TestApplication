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
	
	
	public function initDoctrine() {	
		require_once '../bin/doctrine-config.php';
		
		$connectionOptions = array(
		   'driver'   		=> $this->config['db']['default']['driver'],
		   'unix_socket' 	=> $this->config['db']['default']['socket'],
		   'dbname'   		=> $this->config['db']['default']['db'],
		   'host'     		=> $this->config['db']['default']['host'],
		   'user'     		=> $this->config['db']['default']['user'],
		   'password' 		=> $this->config['db']['default']['passwd'],
		);
		
		$em = Doctrine\ORM\EntityManager::create($connectionOptions, $config);
		
		return $em;
	}
	
	
	public function initMailer() {
		$mail = new PHPMailer(true);
		$mail->setFrom('vistahr@googlemail.com');
		return $mail;
	}
	
	
}









