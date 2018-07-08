<?php  

	namespace App\Controllers\System;

use App\Controllers\BaseController;
use App\Model\EventsModel;

class EventController extends BaseController {
/*	private $events;

	public function __construct()
	{
		$this->events = new EventsModel();
	}*/

	public function getIndex()
	{		
		$events = new EventsModel();
		$upcomingEvents = $events->newEvents();
		$oldEvents = $events->oldEvents();

		return $this->render('event.twig', ['upcomingEvents' => $upcomingEvents, 'oldEvents' => $oldEvents]);


	}

	public function getBriefing($id)
	{
		$events = new EventsModel();
		$eventInfo = $events->briefing($id);
		return $this->render('event_post.twig', ['eventInfo' => $eventInfo]);
	}

		public function getAssistance($id)
	{
		$events = new EventsModel();
		$assistance = $events->assistance($id);
		return $this->render('assistance.twig', ['assistance' => $assistance]);

	}
}

?>