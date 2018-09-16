<?php 

namespace App\Models;

/**
 * 
 */
class usersModel
{
  public function checkUserExist($name)
	{
		global $pdo;

		$sql = 'SELECT * FROM ipb_members AS m 
      JOIN ipb_perscom_personnel AS p 
      ON m.member_id = p.member_id 
      WHERE name = :name';
		$query = $pdo->prepare($sql);
		$result = $query->execute([
			':name' => $name,
		]);

		return $query->fetch(\PDO::FETCH_ASSOC);
	}
}

 ?>