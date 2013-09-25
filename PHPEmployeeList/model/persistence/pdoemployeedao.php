<?php

namespace PHPEmployeeList\Model\Persistence;

use PHPEmployeeList\Model\Domain\Position;
use PHPEmployeeList\Model\Persistence\EmployeeDAO;
use PHPEmployeeList\Model\Domain\Employee;

class PDOEmployeeDAO implements EmployeeDAO
{
	private $field_map = [
		'id' => 'id',
		'first_name' => 'first_name',
		'last_name' => 'last_name',
		'salary' => 'salary',
		'position' => 'position',
		'description' => 'description',
	];

	private $table = "employees";

	public function getAll($field = "id", $direction = "asc")
	{
		if (strlen($field) && array_key_exists($field, $this->field_map)) {
			if ($field == 'position')
				$field = 'pos_name';

		} else {
			$field = "id";
		}

		if (!strlen($direction) || !in_array($direction, ['asc', 'desc'])) {
			$direction = "asc";
		}

		$data = PDODB::getInstance()->getAll($this->table, $field, $direction, array(
			'table' => 'positions',
			'on' => 'positions.id = employees.position',
			'join_fields' => 'positions.id as pos_id, positions.description as pos_description, positions.name as pos_name'
		));

		$employees = [];
		foreach ($data as $row) {
			$employees[] = $this->initEmployee($row, true);
		}

		return $employees;
	}

	public function edit(Employee $employee)
	{
		$data = $this->convertEmployeeToArray($employee);
		unset($data['id']);
		PDODB::getInstance()->edit($this->table, $employee->id, $data);
		return true;
	}

	public function get($id)
	{
		$row = PDODB::getInstance()->get($this->table, $id);
		return $this->initEmployee($row, false);
	}

	public function add(Employee $employee)
	{
		$data = $this->convertEmployeeToArray($employee);
		$id = PDODB::getInstance()->add($this->table, $data);
		$employee->id = $id;
		return $employee;
	}

	public function delete(Employee $employee)
	{
		PDODB::getInstance()->delete($this->table, $employee->id);
		return true;
	}

	public function convertEmployeeToArray(Employee $employee)
	{
		$data = [];
		foreach($this->field_map as $obj_field => $db_field) {
			if ($employee->$obj_field instanceof Position)
				$data[$db_field] = $employee->$obj_field->id;
			else
				$data[$db_field] = $employee->$obj_field;
		}
		return $data;
	}

	public function initEmployee($row, $join_position)
	{
		$employee = new Employee([]);
		foreach($this->field_map as $obj_field => $db_field) {
			if ($obj_field == "position" && $join_position) {
				$position = new Position([]);
				foreach(PDOPositionDAO::getFieldMap() as $pos_obj_field => $pos_db_field) {
					$position->{$pos_obj_field} = $row["pos_".$pos_db_field];
				}
				$employee->{$obj_field} = $position;
			} else
				$employee->{$obj_field} = $row[$db_field];
		}
		return $employee;
	}

}