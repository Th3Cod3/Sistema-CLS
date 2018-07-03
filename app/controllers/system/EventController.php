<?php  

	namespace App\Controllers\System;

use App\Controllers\BaseController;

	class EventController extends BaseController {
		public function getIndex()
		{
			//get all comming events
			$searchDate = new \DateTime();

			global $pdo;

			$sqlDate = $searchDate->format("Y-m-d H:i:s");
			$sql = "SELECT * FROM ipb_cal_events WHERE event_start_date > '$sqlDate'";
			$query = $pdo->query($sql);
			$upcomingEvents = $query->fetchAll(\PDO::FETCH_ASSOC);

			//get all old events
			$sql = "SELECT * FROM ipb_cal_events WHERE event_start_date < '$sqlDate' LIMIT 0, 10 ";
			$query = $pdo->query($sql);
			$oldEvents = $query->fetchAll(\PDO::FETCH_ASSOC);

			return $this->render('event.twig', ['upcomingEvents' => $upcomingEvents, 'oldEvents' => $oldEvents]);


		}
	}

?>