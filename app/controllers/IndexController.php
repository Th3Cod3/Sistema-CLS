<?php  

	namespace App\Controllers;

	class IndexController {
		public function anyIndex()
		{
			header('Location: ' . BASE_URL . '/pointCard');
		}
	}


?>