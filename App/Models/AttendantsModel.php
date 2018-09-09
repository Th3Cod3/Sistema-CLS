<?php 

namespace App\Models;

/**
 * 
 */
class AttendantsModel
{
	public function getAssistanceOptionByType($point_type)
	{
		global $pdo;

		$sql = "SELECT * FROM pcls_assistances_points WHERE point_type = :point_type";

		$query = $pdo->prepare($sql);
		$result = $query->execute([
			'point_type' => $point_type
		]);

		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function checkAssistenceForEvent($event_id, $member_id)
	{
		global $pdo;

		$sql = "SELECT * FROM pcls_assistances WHERE event_id = :event_id AND member_id = :member_id";

		$query = $pdo->prepare($sql);
		$result = $query->execute([
			'event_id' => $event_id,
			'member_id' => $member_id
		]);

		return $query->fetch(\PDO::FETCH_ASSOC);
	}
}

 ?>