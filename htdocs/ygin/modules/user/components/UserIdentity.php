<?php
class UserIdentity extends CUserIdentity {
	
	const ERROR_USER_BLOCKED = 50;
	
  private $_id;
  
  public function getId() {
    return $this->_id;
  }
  
  public function authenticate() {
	$command = Yii::app()->dbU->createCommand("SELECT ClientManagement.ClientAuthorization('".$this->username."','".$this->password."')");
	$codeU = $command->queryRow();
	$codeU=$codeU[''];
	#var_dump($codeU);
	# Авторизируемся в Учёте
	if ($codeU == '0'){
		$this->errorCode = self::ERROR_USERNAME_INVALID;
		#Логин указан неверно пробуем авторизоваться как пользователь сайта
		$userName = mb_strtolower($this->username);
		$user = User::model()->find('LOWER(name) = ?', array($userName));
		if ($user === null) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} elseif ($user->isBlocked()) {
			$this->errorCode = self::ERROR_USER_BLOCKED;
		} elseif (!$user->validatePassword($this->password)) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		} else {
			$this->_id = $user->id_user;
			$this->username = $user->name;
			$this->errorCode = self::ERROR_NONE;
		}
	}elseif( $codeU == '-1'){
		$this->errorCode = self::ERROR_PASSWORD_INVALID;
	}else{
		$this->_id = $codeU;
		$this->username = $this->username;
		$this->errorCode = self::ERROR_NONE;
	}
	  #$userName = mb_strtolower($this->username);
	  #$user = User::model()->find('LOWER(name) = ?', array($userName));
	  #
	#if ($user === null) {
	#  $this->errorCode = self::ERROR_USERNAME_INVALID;
	#} elseif ($user->isBlocked()) {
	#	$this->errorCode = self::ERROR_USER_BLOCKED;
	#} elseif (!$user->validatePassword($this->password)) {
	#   $this->errorCode = self::ERROR_PASSWORD_INVALID;
	#} else {
	# $this->_id = $user->id_user;
	# $this->username = $user->name;
	# $this->errorCode = self::ERROR_NONE;
	#}
 		return $this->errorCode == self::ERROR_NONE;
	}
}