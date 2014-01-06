<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/projects/star_crud/model/Autoloader.php';
require_once ROOT_PATH . '/model/ContactsService.php';

class ContactsController 
{

	private $contactsService = null;

	public function __construct()
	{
		$this->contactsService = new ContactsService();
	}

	public function redirect($location)
	{
		header('Location: ' . $location);
	}

	public function handleRequest()
	{
		$op = isset($_GET['op']) ? $_GET['op'] : null;

		try 
		{
			if (!$op || $op == 'list')
			{
				$this->listContacts();
			}
				elseif ($op == 'new')
				{
					$this->saveContact();
				}
				elseif ($op == 'edit')
				{
					$this->editContact();
				}
				elseif ($op == 'delete')
				{
					$this->deleteContact();
				}
				elseif ($op == 'show')
				{
					$this->showContact();
				}
				else 
				{
					$this->showError("Page not found", "Page for execution" . $op . " was not found");
				}
		}
		catch(Exception $e)
		{
			$this->showError("Application error", $e->getMessage());
		}
	}	

	public function listContacts()
	{
		$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : null;
		$contacts = $this->contactsService->getAllContacts($orderby);
		include ROOT_PATH . 'view/contacts.php';
	}

	public function saveContact()
	{
		$title = 'Create New Contact';

		$name 	= '';
		$email  = '';
		$mobile = '';

		$errors = array();

		if (isset($_POST['form-submitted']))
		{
			$name   = isset($_POST['name'])   ? trim($_POST['name'])   : null;
			$email  = isset($_POST['email'])  ? trim($_POST['email'])  : null;
			$mobile = isset($_POST['mobile']) ? trim($_POST['mobile']) : null;

			try
			{
				$this->contactsService->createNewContact($name, $email, $mobile);
				$this->redirect('index.php');
				return;
			}
			catch(ValidationException $e)
			{
				$errors = $e->getErrors();
			}
		}
		// Include view from Create form
		include ROOT_PATH . '/view/create.php';
	}

	public function editContact()
	{
		$title = 'Edit contact';

		$name   = '';
		$email  = '';
		$mobile = '';
		$id     = $_GET['id'];

		$contact = $this->contactsService->getContact($id);

		$errors = array();

		if (isset($_POST['form-submitted'])) 
		{
			$name   = isset($_POST['name'])   ? trim($_POST['name']) 	   : null;
			$email  = isset($_POST['email'])  ? trim($_POST['email']) 	   : null;
			$mobile = isset($_POST['mobile']) ? trim($_POST['mobile'])     : null;
			
			try 
			{
				$this->contactsService->editContact($name, $email, $mobile, $id);
				$this->redirect('index.php');
				return;
			}
			catch(ValidationException $e)
			{
				$errors = $e->getErrors();
			}
		}
		include ROOT_PATH . 'view/update.php';
	}

	public function deleteContact()
	{

		$id = isset($_GET['id']) ? $_GET['id'] : null;
		
		if (isset($_POST['submit']) == true)
		{
			$this->contactsService->deleteContact($id);

			$this->redirect('index.php');
		}

		if (!$id)
		{
			throw new Exception('Internal error');
		}
		$contact = $this->contactsService->getContact($id);
		
		include ROOT_PATH . 'view/delete.php';	

	}

	public function showContact()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : null;

		$errors = array();

		if (!$id)
		{
			throw new Exception('Internal error');
		}
		$contact = $this->contactsService->getContact($id);

		include ROOT_PATH . 'view/view.php';
	}

	public function showError($title, $message)
	{
		include ROOT_PATH . 'view/error.php';
	}
}

?>
