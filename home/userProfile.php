<?php

class userProfile {
	private $_name ;
	private $_id ;
	private $_picture ;
	private $_email ;

	public function setName($name){
		$this->_name = $name ;
	}

	public function setId($id){
		$this->_id = $id ;
	}

	public function setEmail($email){
		$this->_email = $email ;
	}

	public function setPicture($pic){
		$this->_picture = $pic ;
	}

	public function getName(){
		return $this->_name ;
	}

	public function getId(){
		return $this->_id ;
	}

	public function getEmail(){
		return $this->_email ;
	}

	public function getPicture(){
		return $this->_picture ;
	}
}
?>