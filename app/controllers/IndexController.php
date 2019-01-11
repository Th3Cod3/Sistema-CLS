<?php 

namespace App\Controllers;

use App\Controllers\TwigController;
use Sirius\Validation\Validator;
use App\Models\usersModel;

class IndexController extends TwigController{
	public function getIndex()
	{
		header("Location:".BASE_URL."login");
	}

	public function anyLogin()
	{
		if($this->checkSession())
			header('Location:'.BASE_URL.'points/events');
		else{
			$validator = new Validator();
			$usersModel = new UsersModel();
			if(isset($_POST) && $_POST){
				$validator->add('user', 'required');
				$validator->add('password', 'required');

				if($validator->validate($_POST)){
					$userInfo = $usersModel->checkUserExist($_POST['user']);
					if($userInfo){
						$cryptPass = $this->cryptCLS($_POST['password'],$userInfo['members_pass_salt']);
						if($cryptPass == $userInfo['members_pass_hash']){
							$_SESSION['member_id'] = $userInfo['member_id'];
							$_SESSION['name'] = $userInfo['name'];
							$_SESSION['power'] = 1;
							$_SESSION['combat_unit'] = 1;
							$_SESSION['firstname'] = $userInfo['firstname'];
							$_SESSION['lastname'] = $userInfo['lastname'];
							$_SESSION['combat_unit'] = $userInfo['combat_unit'];
							$_SESSION['admin_unit'] = $userInfo['admin_unit'];
							$_SESSION['rank'] = $userInfo['rank'];

							header("Location:".BASE_URL."points/events");
							return null;
						}
					}
					$validator->addMessage('Error','El usuario o contraseña no coinciden');
				}
				$errors = $validator->getMessages();
			}

			return $this->render('login.twig', [
				'delnav' => true, 
				'errors' => $errors ?? ''
			]);
		}
	}

	public function checkSession()
	{
		if(isset($_SESSION['member_id']))
			return 1;
		else
			return 0;
	}

		public function anyLogout()
	{
		session_destroy();
		header("Location:".BASE_URL."login");
	}

	public function cryptCLS($send_pass,$saltDB)
	{
		if(strlen($saltDB) > 5){
				return crypt($send_pass, '$2a$13$' . $saltDB);
		}else{
			return md5(md5($saltDB).md5($send_pass));
		}
	}

}


?>