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
		$error = array();
		
		if($this->getRequest()->issetGet()) {
			$activationCode = $this->getRequest()->getGet('acode');
			
			$em = $this->getResource('Doctrine');
			$customer = $em->getRepository('Frontend\Customers')->findOneBy(array('activation_code' => $activationCode));
			
			if($customer === null)
				$error[] = 'Ungültiger Aktivierungscode';

			
		}
		
		$this->getView()->assign('error',$error);
	}
	
	
	public function loginAction() {
		
	}
	
	

	
	
	public function cancleAction() {
		
	}
	
	
	public function retrievePasswordAction() {
		
	}
	
	
	public function dataAction() {
		
	}
	
	
	
}