<?php 

namespace App\Controllers;

use App\Controllers\BaseController;

class IndexController extends BaseController{
	public function anyIndex()
	{
		header('Location: ' . BASE_URL . 'points');
	}
}


?>