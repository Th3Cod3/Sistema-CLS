<?php  

namespace App\Controllers\System;

use App\Controllers\BaseController;
use App\Models\PointsModel;

class PointsController extends BaseController
{
	public function getIndex()
	{
		$pointsModel = new PointsModel();
		$soldiers = $pointsModel->getAllNames();

		return $this->render('search-soldier.twig',[
			'soldiers' => $soldiers
		]);
	}

	public function postSearch()
	{
		$pointsModel = new PointsModel();
		$soldiers = $pointsModel->search($_POST['cls-soldier']);
		var_dump($soldiers[0]['member_id']);
		header("Location:".BASE_URL.'points/soldierinfo/'.$soldiers[0]['member_id']);
	}

	public function getSoldierinfo($soldier_id)
	{
		$pointsModel = new PointsModel();
		$soldier = $pointsModel->getSoldier($soldier_id);

		$assistancePoints = $pointsModel->getPointsByMember($soldier['member_id']);

		return $this->render('point-card.twig',[
			'soldierInfo' => $soldier, 
			'assistancePoints' => $assistancePoints
		]);
	}
}


?>