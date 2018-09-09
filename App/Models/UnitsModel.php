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

		$sql = "SELECT * FROM ipb_perscom_personnel AS pp 
			JOIN ipb_members AS m 
			ON pp.member_id=m.member_id 
			WHERE pp.combat_unit = :combat_unit";

		$query = $pdo->prepare($sql);
		$result = $query->execute([
			'combat_unit' => $combat_unit
		]);

		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}
}

 ?>