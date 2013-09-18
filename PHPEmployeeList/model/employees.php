<?php

namespace PHPEmployeeList\Model;

class Employees implements ModelInterface
{

	public static $fields = array(
		'first_name' => 'string',
		'last_name' => 'string',
		'salary' => 'int',
		'position' => 'int',
		'description' => 'string',
	);

	public static $table = "employees";

	public static function getList($field = "name", $direction = "asc")
	{
		return DB::getInstance()->getList(self::$table, array(
			'order' => $field.' '.$direction,
			'join' => 'positions',
			'on' => 'positions.id = employees.position',
			'join_fields' => 'positions.id as pos_id, positions.description as pos_desc, positions.name as pos_name'
		));
	}

	public static function edit($id, $data)
	{
		DB::getInstance()->edit(self::$table, $id, $data);
	}

	public static function get($id)
	{
		return DB::getInstance()->get(self::$table, $id);
	}

	public static function add($data)
	{
		DB::getInstance()->add(self::$table, $data);
	}

	public static function delete($id)
	{
		DB::getInstance()->delete(self::$table, $id);
	}

	public static function validate($data)
	{
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