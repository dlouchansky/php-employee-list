<?php

namespace PHPEmployeeList\Model\Persistence;

use PHPEmployeeList\Model\Persistence\PositionDAO;
use PHPEmployeeList\Model\Domain\Position;

class PDOPositionDAO implements PositionDAO
{

	private static $field_map = [
		'id' => 'id',
		'name' => 'name',
		'description' => 'description',
	];

	public static function getFieldMap() {
		return self::$field_map;
	}

	private $table = "positions";

	public function getAll($field = 'name', $direction = 'asc')
	{
		$data = PDODB::getInstance()->getAll($this->table, $field, $direction);

		$positions = [];
		foreach ($data as $row) {
			$positions[] = $this->initPosition($row);
		}

		return $positions;
	}

	public function edit(Position $position)
	{
		$data = $this->convertPositionToArray($position);
		unset($data['id']);
		PDODB::getInstance()->edit($this->table, $position->id, $data);
		return true;
	}

	public function get($id)
	{
		$row = PDODB::getInstance()->get($this->table, $id);
		return $this->initPosition($row);
	}

	public function add(Position $position)
	{
		$data = $this->convertPositionToArray($position);
		$id = PDODB::getInstance()->add($this->table, $data);
		$position->id = $id;
		return $position;
	}

	public function delete(Position $position)
	{
		PDODB::getInstance()->delete($this->table, $position->id);
		return true;
	}

	public function convertPositionToArray(Position $position) {
		$data = [];
		foreach(self::$field_map as $obj_field => $db_field) {
			$data[$db_field] = $position->$obj_field;
		}
		return $data;
	}

	public function initPosition($row) {
		$position = new Position([]);
		foreach(self::$field_map as $obj_field => $db_field) {
			$position->{$obj_field} = $row[$db_field];
		}
		return $position;
	}

}