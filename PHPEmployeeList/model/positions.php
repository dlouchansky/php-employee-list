<?php

namespace PHPEmployeeList\Model;

class Positions implements ModelInterface
{

	public static $fields = array(
		'name' => 'string',
		'description' => 'string',
	);

	public static $table = "positions";

	public static function getList()
	{
		return DB::getInstance()->getList(self::$table);
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

		if (!isset($data['name']) || !strlen($data['name'])) {
			$errors[] = 'Название обязательно';
		}

		return $errors;
	}

}