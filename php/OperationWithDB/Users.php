<?php

namespace OperationWithDB;

class Users implements IDatabase
{
	protected  $user_id;
	protected  $firstName;
	protected  $lastName;
	protected  $password;
	protected  $email;

	public function __construct($password, $email, $firstName = null, $lastName = null)
	{
		$this->user_id = '';
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->password = $password;
		$this->email = $email;
	}
	
	public function getFields()
	{
		return [
			'user_id' => $this->user_id,
			'first_name' => $this->firstName,
			'last_name' => $this->lastName,
			'password' => $this->password,
			'email' => $this->email
		];
	}
	
	public function getFirstName()
	{
		return 'first_name';
	}
	
	public function getLastName()
	{
		return 'last_name';
	}
	
	public function getFirstNameValue()
	{
		return $this->firstName;
	}
	
	public function getLastNameValue()
	{
		return $this->lastName;
	}
	
	public function getPassword()
	{
		return 'password';
	}
	
	public function getPasswordValue()
	{
		return $this->password;
	}
	
	public function getEmail()
	{
		return 'email';
	}
	
	public function getEmailValue()
	{
		return $this->email;
	}
	
	public function getPrimaryKey()
	{
		return 'user_id';
	}
	
	public function getPrimaryKeyValue()
	{
		return $this->user_id;
	}
	
	public function getTableName()
	{
		return 'users';
	}
	
	public function setFieldsFromDb($fieldValues)
	{
		$fields = $this->getFields();
		
		foreach ($fieldValues as $name => $value) {
			if (isset($fields[$name])) {
				$this->$name = $value;
			}
		}
	}
	
	public function setPrimaryKeyValue($value)
	{
		$this->user_id = $value;
	}
	
	public function checkLogin()
	{
		$sqlEmail = sprintf('SELECT * FROM %s WHERE %s = ?', 
				$this->getTableName(), 
				$this->getEmail()
			);
		
		$dataEmail = Database::query($sqlEmail, [$this->getEmailValue()]);
		
		if ((!empty($dataEmail)) && ($dataEmail[0]['password'] == $this->getPasswordValue())) {
			return $dataEmail;
		}
		return false;
	}
	
	public function checkEmail()
	{
		$sqlEmail = sprintf('SELECT * FROM %s WHERE %s = ?', 
				$this->getTableName(), 
				$this->getEmail()
			);
		
		$dataEmail = Database::query($sqlEmail, [$this->getEmailValue()]);
		
		return $dataEmail ? $dataEmail : false;
	}
}