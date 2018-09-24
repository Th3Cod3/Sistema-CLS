<?php 

namespace App\Models;

/**
 * 
 */
class UnitsModel
{
	public function getCombatUnits()
	{
		global $pdo;

		$sql = "SELECT * FROM ipb_perscom_combat_units";
		$query = $pdo->query($sql);


		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function personnelByUnit($combat_unit)
	{
		global $pdo;

		$sql = "SELECT pp.member_id, m.name FROM ipb_perscom_personnel AS pp 
			JOIN ipb_members AS m 
			ON pp.member_id = m.member_id 
			WHERE pp.combat_unit = :combat_unit";

		$query = $pdo->prepare($sql);
		$result = $query->execute([
			'combat_unit' => $combat_unit
		]);

		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getRanks()
	{
		global $pdo;

		$sql = "SELECT * FROM ipb_perscom_ranks";
		$query = $pdo->query($sql);


		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getForumGroups()
	{
		global $pdo;

		$sql = "SELECT g_title, g_id FROM ipb_groups";
		$query = $pdo->query($sql);


		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}


}

 ?>