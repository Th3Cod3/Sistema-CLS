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

	public function checkAssistanceForEvent($event_id, $member_id)
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

	public function saveAttendant($request)
	{
		global $pdo;

		$sql = 'INSERT INTO pcls_assistances(member_id, event_id, assistance_point_id) VALUES (:member_id, :event_id, :assistance_point_id)';

		$query = $pdo->prepare($sql);
		$result = $query->execute([
			'member_id' => $request['member_id'],
			'assistance_point_id' => $request['assistance_point_id'],
			'event_id' => $request['event_id']
		]);

		return $result;
	}

	public function updateAttendant($request)
	{
		global $pdo;

		$sql = 'UPDATE pcls_assistances SET assistance_point_id = :assistance_point_id WHERE member_id = :member_id AND event_id = :event_id';

		$query = $pdo->prepare($sql);
		$result = $query->execute([
			'member_id' => $request['member_id'],
			'assistance_point_id' => $request['assistance_point_id'],
			'event_id' => $request['event_id']
		]);

		return $result;
	}
}

 ?>