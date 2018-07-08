<?php  
namespace App\Model;


class EventsModel 
{
	public function newEvents()
	{			
		global $pdo;
		$searchDate = new \DateTime("10 may 2018");
		$sqlDate = $searchDate->format("Y-m-d H:i:s");

		$sql = "SELECT 
				e.event_id, 
				e.event_title, 
				e.event_start_date, 
				m.name
			FROM ipb_cal_events as e 
			JOIN ipb_members as m 
			ON e.event_member_id=m.member_id 
			WHERE event_start_date >= '$sqlDate' 
			ORDER BY e.event_start_date 
			DESC";

		$query = $pdo->query($sql);
		$upcomingEvents = $query->fetchAll(\PDO::FETCH_ASSOC);

		return $upcomingEvents;
	}

	public function oldEvents()
	{	
		global $pdo;
		$searchDate = new \DateTime("10 may 2018");
		$sqlDate = $searchDate->format("Y-m-d H:i:s");

		$sql = "SELECT 
				e.event_id, 
				e.event_title, 
				e.event_start_date, 
				m.name 
			FROM ipb_cal_events as e 
			JOIN ipb_members as m 
			ON e.event_member_id=m.member_id 
			WHERE event_start_date < '$sqlDate' 
			ORDER BY e.event_start_date 
			DESC 
			LIMIT 0, 10 ";

		$query = $pdo->query($sql);
		$oldEvents = $query->fetchAll(\PDO::FETCH_ASSOC);

		return $oldEvents;
	}
	
	public function briefing($id)
	{
		global $pdo;

		$sql = "SELECT 
				e.event_id, 
				e.event_title, 
				e.event_start_date, 
				m.name, 
				e.event_content 
			FROM ipb_cal_events as e 
			JOIN ipb_members as m 
			ON e.event_member_id=m.member_id 
			WHERE e.event_id = $id";

		$query = $pdo->query($sql);
		$eventInfo = $query->fetchAll(\PDO::FETCH_ASSOC);
		return $eventInfo;

	}

	public function assistance($id)	
	{
		global $pdo;

		$sql = "SELECT 
				e.event_id, 
				e.event_title, 
				e.event_start_date, 
				m.name 
			FROM ipb_cal_events as e 
			JOIN ipb_members as m 
			ON e.event_member_id=m.member_id 
			WHERE e.event_id = $id";

		$query = $pdo->query($sql);
		$eventInfo = $query->fetchAll(\PDO::FETCH_ASSOC);

		$sql = "SELECT 
				pp.member_id, 
				m.name 
			FROM ipb_perscom_personnel as pp 
			JOIN ipb_members as m 
			ON pp.member_id=m.member_id 
			WHERE pp.combat_unit = 1";
		$query = $pdo->query($sql);
		$alpha = $query->fetchAll(\PDO::FETCH_ASSOC);

		$sql = "SELECT 
				pp.member_id, 
				m.name 
			FROM ipb_perscom_personnel as pp 
			JOIN ipb_members as m 
			ON pp.member_id=m.member_id 
			WHERE pp.combat_unit = 2";
		$query = $pdo->query($sql);
		$bravo = $query->fetchAll(\PDO::FETCH_ASSOC);

		$sql = "SELECT 
				pp.member_id, 
				m.name 
			FROM ipb_perscom_personnel as pp 
			JOIN ipb_members as m 
			ON pp.member_id=m.member_id 
			WHERE pp.combat_unit = 4";
		$query = $pdo->query($sql);
		$recruit = $query->fetchAll(\PDO::FETCH_ASSOC);

		$sql = "SELECT 
				pp.member_id, 
				m.name 
			FROM ipb_perscom_personnel as pp 
			JOIN ipb_members as m 
			ON pp.member_id=m.member_id 
			WHERE pp.combat_unit = 9";
		$query = $pdo->query($sql);
		$state = $query->fetchAll(\PDO::FETCH_ASSOC);


		return ['alpha' => $alpha, 'bravo' => $bravo, 'recruit' => $recruit, 'state' => $state,];
	}
}

?>