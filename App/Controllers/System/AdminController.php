<?php  

namespace App\Controllers\System;

use App\Controllers\TwigController;
use App\Models\UnitsModel;

class AdminController extends TwigController
{
  public function anyIndex()
  {
    return $this->render('admin/dashboard.twig');
  }

	public function anyCombat_unit()
	{
		if(isset($_POST)){
			
		}
		$unitsModel = new UnitsModel();
		$combatUnits = $unitsModel->getCombatUnits();
		return $this->render('admin/combat_unit.twig',[
			'combatUnits' => $combatUnits
		]);
	}

	public function anyRank()
	{
		$unitsModel = new UnitsModel();
		$ranks = $unitsModel->getRanks();
		return $this->render('admin/rank.twig',[
			'ranks' => $ranks
		]);
	}

	public function anyPermission()
	{
		$unitsModel = new UnitsModel();
		$groups = $unitsModel->getForumGroups();
		return $this->render('admin/permission.twig',[
			'groups' => $groups
		]);
	}

	public function anyPoints_card()
	{
		
		return $this->render('admin/points_card.twig',[
			
		]);
	}
}

?>