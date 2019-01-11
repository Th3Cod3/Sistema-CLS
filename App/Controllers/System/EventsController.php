<?php  

namespace App\Controllers\System;

use App\Controllers\TwigController;
use App\Models\EventsModel;
use App\Models\UnitsModel;
use App\Models\attendantsModel;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class EventsController extends TwigController {
	public function anyIndex()
	{
		header('Location:'.BASE_URL.'points/events');
	}

	public function getEvents()
	{
		$eventsModels = new EventsModel();
		$upcomingEvents = $eventsModels->newEvents();
		$oldEvents = $eventsModels->oldEvents();
		
		return $this->render('events/event.twig', [
			'upcomingEvents' => $upcomingEvents, 
			'oldEvents' => $oldEvents
		]);
	}

	public function getBriefing($event_id)
	{
		$eventsModels = new EventsModel();
		$eventInfo = $eventsModels->briefing($event_id);
		return $this->render('events/event_post.twig', [
			'eventInfo' => $eventInfo
		]);
	}

	public function anyAssistance($event_id)
	{
		$button = 'Ver';
		$eventsModels = new EventsModel();
		$unitsModel = new UnitsModel();
		$attendantsModel = new AttendantsModel();
		if(isset($_POST['soldiers'])){
			foreach ($_POST['soldiers'] as $soldier) {
				$exist = $attendantsModel->checkAssistanceForEvent($event_id, $soldier['member_id']);
				$soldier['event_id'] = $event_id;
				if($soldier['assistance_point_id']){
					if (!$exist)
						$save = $attendantsModel->saveAttendant($soldier);
					else
						$save = $attendantsModel->updateAttendant($soldier);
				}

			}
		}
		
		$combat_units = $unitsModel->getCombatUnitsByPower($_SESSION['power'],$_SESSION['combat_unit']);
		if(isset($_POST['unit_id'])){
			$button = 'Guardar';
			
			$personnel = $unitsModel->personnelByUnit($_POST['unit_id']);
			$attendantOption = $attendantsModel->getAssistanceOptionByType(1);
			foreach ($personnel as $key => $soldier) {
				$attendant = $attendantsModel->checkAssistanceForEvent($event_id, $soldier['member_id']);
				if ($attendant)
					$personnel[$key]['attendantPoint'] = $attendant['assistance_point_id'];

			}
		}
		

		return $this->render('events/assistance.twig', [
			'event_id' => $event_id,
			'personnel' => $personnel ?? '', 
			'combat_units' => $combat_units, 
			'attendantOption' => $attendantOption ?? '', 
			'button' => $button,
			'attendantRequest' => $_POST ?? $attendant
		]);

	}

	public function anyDmos()
	{
		return $this->render('events/dmos.twig', [
			
		]);
	}

/*	public function getImport()
	{
		global $pdo;
		$file = "alfa.xlsx";
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);

		$member_id = 0;
		$letras = range('A','Z');
		for($letra = 1; $letra < 26; $letra++){
			for($i = 1; $i < 160; $i++){
				if($i == 1){

					$cell = $letras[$letra].$i;
					$member_id = $spreadsheet->getSheet(0)->getCell($cell)->getValue();
					$i = 3;
					
					
				}
				$cell = $letras[$letra].$i;
				$point = $spreadsheet->getSheet(0)->getCell($cell)->getValue();
				$aCell = 'A'.$i;
				$event = $spreadsheet->getSheet(0)->getCell($aCell)->getValue();

				if($point){
				$sql = "INSERT INTO pcls_assistances(
						member_id,
						event_id,
						assistance_point_id 
						 )
						 VALUES ($member_id,$event,$point)
					";
				$query = $pdo->query($sql);

				
					if($i == 3){

						$points = [[$member_id,$point, $event]];
					}else{
					array_push($points,[[$member_id,$point, $event]]);
					}
					var_dump($event);
					var_dump($point);
					var_dump($member_id);
					echo '<hr>';
				}
			}
		}



		echo '<br><hr><br>';
		var_dump($points);

	}*/
}

?>