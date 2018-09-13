<?php  

namespace App\Controllers\System;

use App\Controllers\BaseController;
use App\Models\PointsModel;

class PointsController extends BaseController
{
	public function anySearch()
	{
		$pointsModel = new PointsModel();
		$soldiers = $pointsModel->getAllNames();
		$pointsModel = new PointsModel();
		if(isset($_POST['cls-soldier'])){
			$soldier = $pointsModel->search($_POST['cls-soldier']);
			if($soldier)
				header("Location:".BASE_URL.'points/card/soldierinfo/'.$soldier['member_id']);
		}

		return $this->render('point-card/search-soldier.twig',[
			'soldiers' => $soldiers
		]);
	}

	public function getSoldierinfo($soldier_id)
	{
		$pointsModel = new PointsModel();
		$soldier = $pointsModel->getSoldier($soldier_id);

		$assistancePoints = $pointsModel->getPointsByMember($soldier['member_id']);

		return $this->render('point-card/point-card.twig',[
			'soldierInfo' => $soldier, 
			'assistancePoints' => $assistancePoints
		]);
	}
}


?>