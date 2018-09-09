<?php  

	namespace App\Controllers;

	class IndexController extends BaseController{
		public function anyIndex()
		{
			header('Location: ' . BASE_URL . 'points');
		}
	}


?>