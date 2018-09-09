<?php 

namespace App\Models;

/**
 *  sd
 */
class PointsModel
{
	
	public function search($user_name)
	{
		global $pdo;

		$sql = 'SELECT * FROM ipb_members WHERE name = :name';
		$query = $pdo->prepare($sql);
		$query->execute([
			':name' => $user_name
		]);

		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getAllNames()
	{
		global $pdo;

		$sql = 'SELECT m.name FROM ipb_perscom_personnel AS p
			JOIN ipb_members AS m
			ON p.member_id = m.member_id
			WHERE combat_unit != 6
			AND combat_unit != 8 
			ORDER BY m.name ASC';

		$query = $pdo->query($sql);

		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getPointsByMember($member_id)
	{
		global $pdo;

		$sql = 'SELECT sum(point_value) as total_points, SUM(IF(a.assistance_point_id=1,1,0)) as training, SUM(IF(a.assistance_point_id=2,1,0)) as mission, SUM(IF(a.assistance_point_id=3,1,0)) as parcial, SUM(IF(a.assistance_point_id=5,1,0)) as absence, SUM(p.assistance_value) AS assitance FROM pcls_assistances AS a JOIN pcls_assistances_points AS p ON a.assistance_point_id = p.assistance_point_id WHERE a.member_id = :member_id';

		$query = $pdo->prepare($sql);
		$query->execute([
			':member_id' => $member_id
		]);

		return $query->fetch(\PDO::FETCH_ASSOC);
	}

	public function getSoldier($member_id)
	{
		global $pdo;

		$sql = 'SELECT * FROM ipb_members AS m
			JOIN ipb_perscom_personnel AS p
			ON m.member_id = p.member_id 
			WHERE m.member_id = :member_id';

		$query = $pdo->prepare($sql);
		$query->execute([
			':member_id' => $member_id
		]);

		return $query->fetch(\PDO::FETCH_ASSOC);
	}


}

 ?>