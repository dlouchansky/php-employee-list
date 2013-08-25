<?php

class Employees {
	public static $fields = array(
		'first_name' => 'string',
		'last_name' => 'string',
		'salary' => 'int',
		'position' => 'int',
		'description' => 'string',
	);

	public static $table = "employees";

	public static function GetList($field = "name", $direction = "asc") {
		return DB::GetInstance()->GetList('employees', array(
			'order' => $field.' '.$direction,
			'join' => 'positions',
			'on' => 'positions.id = employees.position',
			'join_fields' => 'positions.id as pos_id, positions.description as pos_desc, positions.name as pos_name'
		));
	}

	public static function Edit($id, $data) {
		DB::GetInstance()->Edit('employees', $id, $data);
	}

	public static function Get($id) {
		return DB::GetInstance()->Get('employees', $id);
	}

	public static function Add($data) {
		DB::GetInstance()->Add('employees', $data);
	}

	public static function Delete($id) {
		DB::GetInstance()->Delete('employees', $id);
	}

	public static function Validate($data) {
		$errors = array();

		if (!isset($data['first_name']) || !strlen($data['first_name'])) {
			$errors[] = 'Имя обязательно';
		}

		if (!isset($data['last_name']) || !strlen($data['last_name'])) {
			$errors[] = 'Фамилия обязательна';
		}

		if (!isset($data['position']) || !$data['position']) {
			$errors[] = 'Должность обязательна';
		}

		if (isset($data['salary']) && !(int)$data['salary']) {
			$errors[] = 'Оклад должен быть положительным целым числом';
		}

		return $errors;
	}

}