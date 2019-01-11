<?php

namespace App\Models;

class Model
{
	private $pdo;
	public function __construct() {
		global $pdo;
		$this->$pdo = $pdo;
	}
	public function modelInsert($table, $fields, $values)
	{
		global $pdo;

		$sql = "INSERT INTO :table ( :fields ) VALUES ( :values )";
	}
}
