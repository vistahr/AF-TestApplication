<?php

class MainController extends \Anemo\Controller 
{
	
	public function init() {
		$this->getView()->assign('textile',$this->getResource('textile'));
	}
	
	
	public function mainAction() {
		// send Ajax
		//return $this->sendAjax(array('irgendwas'=>'tolles'));
		
		// send XML 
		//return $this->sendXML('<anemo><version>1</version></anemo>');
		
		// anderes Template laden
		//$this->loadTemplate('nice');
		
		// weiterleiten
		//return $this->forwardAndExit('default','test','bla');
		
		//$this->getResource('acl')->getInfo();
		
		//var_dump($this->getResource('acl')->isAllowed('moderator', 'backend', 'edit'));
	}
	
	
	public function niceAction() {
		return $this->forwardAndExit('frontend','main','login');
	}
		
	
	public function loginAction() {
		$this->getView()->assign('login_fail',false);
		
		$ID = \Anemo\ID::getInstance();
			
		// wenn eingeloggt
		if($ID->isLogged())
			return $this->forwardAndExit('frontend','main','data');
		
		
		if($this->getRequest()->issetPost()) {
			$user	= $this->getRequest()->getPost('user');
			$passwd = $this->getRequest()->getPost('passwd');
			
			# LOGINVORGANG
			if($user == 'admin' && $passwd == 'admin') {
				$ID->setSubject(new \Anemo\ACL\Subject('admin'));
				// $ID->setUserModel(); setzen falls ein von z.B Doctrine Model des Users existiert
				return $this->forwardAndExit('frontend','main','main');
			} else {
				$this->getView()->assign('login_fail','Logindaten nicht korrekt');
			}
			
		}
	
	}
	
	
	public function dataAction() {
		$this->getView()->assign('ID',\Anemo\ID::getInstance());
	}
	
	
	public function logoutAction() {
		\Anemo\ID::getInstance()->logout();
		return $this->forwardAndExit('frontend','main','main');
	}
	
	
	public function sanskritAction() {
		if(!\Anemo\ID::getInstance()->isLogged())
			return $this->forwardAndExit('frontend','main','main');
	}
	
	
	public function xmlTestAction() {
		$this->getView()->assign('outxml',false);
		
		if($this->getRequest()->issetPost()) {
			$xmlInput = $this->getRequest()->getPost('xml');
			
			$xml = \Anemo\Import::factory('Anemo\Import\Adapter\XML');
			var_dump($xml->toArray($xmlInput));
			$this->getView()->assign('outxml',$xml->toArray($xmlInput));
		}
	}
	
	
	
	public function uploadAction() {
		
	}
	
	
}












