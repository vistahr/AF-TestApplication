<?php

class AccountController extends \Anemo\Controller
{
	
	
	public function registerAction() {
		$error = array();
		$data  = array();
		
		if($this->getRequest()->issetPost()) {
			$data['username'] 			= $this->getRequest()->getPost('username');
			$data['password'] 			= $this->getRequest()->getPost('password');	
			$data['password_confirm'] 	= $this->getRequest()->getPost('password_confirm');
			$data['mail'] 				= $this->getRequest()->getPost('mail');	
			$data['postcode'] 			= $this->getRequest()->getPost('postcode');
			
			
			/*
			if(!\Anemo\Validate::chain($data['username'], array('Alnum' => true, 'LengthBetween' => array(3,32))))
				$error[] = 'Username nicht gültig';

			if(!\Anemo\Validate::chain($data['password'], array('NotEmpty' => true, 'Alnum' => true, 'MaxLength' => array(32))))
				$error[] = 'Username nicht gültig';	
				
			if(!\Anemo\Validate::chain($data['postcode'], array('Postcode' => true))))
				$error[] = 'Username nicht gültig';

			
			\Anemo\Validate::check($data,array('Postcode' => true))
			
			*/	
				
			if($data['password'] == '' || $data['password_confirm'] != $data['password'])
				$error[] = 'Passwörter stimmen nicht überein';

			
			$em = $this->getResource('Doctrine');
			$customer = $em->getRepository('Frontend\Customers')->findOneBy(array('username' => $data['username']));
			
			if($customer !== null)
				$error[] = 'Benutzername existiert schon';
			
			if(count($error) == 0) {
				$customer = new Frontend\Customers;
				$customer->setUsername($data['username']);
				$customer->setPassword(md5($data['password']));
				$customer->setMail($data['mail']);
				$customer->setPostcode($data['postcode']);
				$customer->setCreatedAt(new \DateTime('now'));
				$customer->setSubject('user');
				$customer->setStatus(0);
				
				$activationCode = md5(time());
				$customer->setActivationCode($activationCode);
				
				$em->persist($customer);
				$em->flush();
				
				$mailBody = $em->getRepository('Frontend\Mails')->findOneBy(array('name' => 'account-created'));
				
				$mail = $this->getResource('Mailer');
				$mail->AddAddress($data['mail'],$data['username']);
				$mail->Subject = 'Account erfolgreich erstellt';
				$mail->AltBody = strip_tags($mailBody);
				
				$textile = $this->getResource('Textile');
				$mail->MsgHTML($textile->TextileThis($mailBody));
				
				$mail->Send();
				
				
				return $this->forwardAndExit('frontend','account','accountcreated');
			}
			
		}	
		
		$this->getView()->assign('data',$data);
		$this->getView()->assign('error',$error);
	}
	
	
	
	public function accountCreatedAction(){}
	
	
	
	public function activateAction() {
		$error 	 = array();
		$success = false;
		
		if($this->getRequest()->issetGet()) {
			$activationCode = $this->getRequest()->getGet('acode');
			
			$em = $this->getResource('Doctrine');
			$customer = $em->getRepository('Frontend\Customers')->findOneBy(array('activation_code' => $activationCode));
			
			if($customer === null) {
				$error[] = 'Ungültiger Aktivierungscode';
				
			} else {
				$customer->setStatus(1);
				$customer->setActivationCode(null);
				$em->persist($customer);
				$em->flush();
				
				$success = true;
			}
				
		}
		
		$this->getView()->assign('success',$success);
		$this->getView()->assign('error',$error);
	}
	
	
	public function loginAction() {
		$this->getView()->assign('login_fail',false);
		
		$ID = \Anemo\ID::getInstance();
			
		// wenn eingeloggt
		if($ID->isLogged())
			return $this->forwardAndExit('frontend','account','data');
		
		
		if($this->getRequest()->issetPost()) {
			$user	= $this->getRequest()->getPost('user');
			$passwd = $this->getRequest()->getPost('password');
			
			
			$em = $this->getResource('Doctrine');
			$customer = $em->getRepository('Frontend\Customers')->findOneBy(array('username' => $user,'password' => md5($passwd), 'status' => 1 ));
			
			if($customer !== null) {
				$ID->setUserModel($customer);
				$ID->setSubject(new \Anemo\ACL\Subject($customer->getSubject()));
				return $this->forwardAndExit('frontend','account','data');
			}
			
			$this->getView()->assign('login_fail',true);
		}
		
	}
	
	
	public function logoutAction() {
		$ID = \Anemo\ID::getInstance();
		
		if(!$ID->isLogged())
			return $this->forwardAndExit('frontend','account','login');
		
		$ID->logout();
		
		return $this->forwardAndExit('frontend','account','login');
	}
	
	
	
	public function dataAction() {
		$ID = \Anemo\ID::getInstance();
			
		if(!$ID->isLogged())
			return $this->forwardAndExit('frontend','account','login');
		
		$this->getView()->assign('userdata',$ID->getUserModel());
	}	
	
	
	public function retrievePasswordAction() {
		$this->getView()->assign('retrieve_fail',false);
		
		if($this->getRequest()->issetPost()) {
			$user		= $this->getRequest()->getPost('user');
			$mail 		= $this->getRequest()->getPost('mail');
			
			$em = $this->getResource('Doctrine');
			$customer = $em->getRepository('Frontend\Customers')->findOneBy(array('username' => $user, 'mail' => $mail ));
			
			if($customer === null) {
				$this->getView()->assign('retrieve_fail',true);
				return false;
			}
			
				
			
		}
		
		
		
	}	
	
	
	public function cancleAction() {
		
	}
	
	
	

	
	

	
	
	
	
}