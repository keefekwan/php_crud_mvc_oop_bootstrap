<?php

require_once 'ContactsGateway.php';
require_once 'ValidationException.php';
require_once 'Database.php';

class ContactsService extends ContactsGateway
{

	private $contactsGateway = null;

	public function __construct()
	{
		$this->contactsGateway = new ContactsGateway();
	}

	public function getAllContacts($order)
	{
		try
		{
			self::connect();
			$result = $this->contactsGateway->selectAll($order);
			self::disconnect();
			return $result;
		}
		catch(Exception $e)
		{	
			self::disconnect();
			throw $e;
		}
	}

	public function getContact($id)
	{
		try
		{
			self::connect();
			$result = $this->contactsGateway->selectById($id);
			self::disconnect();
		}
		catch(Exception $e)
		{	
			self::disconnect();
			throw $e;
		}
		return $this->contactsGateway->selectById($id);
	}

	private function validateContactParams($name, $email, $mobile)
	{
		$errors = array();

		if ( !isset($name) || empty($name) ) { 
		    $errors[] = 'Name is required'; 
		}
		if ( !isset($email) || empty($email) ) { 
		    $errors[] = 'Email is required'; 
		}
		if ( !isset($mobile) || empty($mobile) ) { 
		    $errors[] = 'Mobile is required'; 
		}
		if (empty($errors))
		{
			return;
		}
		throw new ValidationException($errors);
	}

	public function createNewContact($name, $email, $mobile)
	{
		try 
		{
			self::connect();
			$this->validateContactParams($name, $email, $mobile);
			$result = $this->contactsGateway->insert($name, $email, $mobile);
			self::disconnect();
			return $result;
		}
		catch(Exception $e)
		{
			self::disconnect();
			throw $e;
		}
	}

	public function editContact($name, $email, $mobile, $id)
	{
		try 
		{
			self::connect();
			$result = $this->contactsGateway->edit($name, $email, $mobile, $id);
			self::disconnect();
		}
		catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
	}
	public function deleteContact($id)
	{
		try
		{
			self::connect();
			$result = $this->contactsGateway->delete($id);
			self::disconnect();
		}
		catch(Exception $e)
		{
			self::disconnect();
			throw $e;
		}
	}

}

?>
