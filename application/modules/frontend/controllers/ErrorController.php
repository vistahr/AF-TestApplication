<?php

class ErrorController extends \Anemo\Controller
{
	
	public function errorAction() {
		$this->getView()->assign('exception',$this->getResponse()->getException());
	}
	
	// Access denied
	public function error401Action() {}
	
	/// Not found
	public function error404Action() {}
	
	
	
}