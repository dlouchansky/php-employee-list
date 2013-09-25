<?php

namespace PHPEmployeeList\Model;


use PHPEmployeeList\Model\Domain\Employee;
use PHPEmployeeList\Model\Persistence\EmployeeDAO;
use PHPEmployeeList\Model\Persistence\PositionDAO;

class EmployeeModel implements EmployeeListModel, SingleEmployeeModel
{

	private $employee_dao;
	private $position_dao;

	private $errors = [];
	private $employee;
	private $field = '';
	private $direction = '';

	public function __construct(EmployeeDAO $_employee_dao, PositionDAO $_position_dao)
	{
		$this->employee_dao = $_employee_dao;
		$this->position_dao = $_position_dao;
	}

	public function setEmployee($id) {
		$this->employee = $this->employee_dao->get($id);
	}

	public function getEmployee($id = null)
	{
		if ($id != null)
			return $this->employee_dao->get($id);

		if ($this->employee != null)
			return $this->employee;

		return new Employee([]);
	}

	public function getPositions()
	{
		return $this->position_dao->getAll();
	}

	public function getEmployees()
	{
		return $this->employee_dao->getAll($this->field, $this->direction);
	}

	public function filterEmployees($field, $direction) {
		$this->field = $field;
		$this->direction = $direction;
	}

	public function deleteEmployee($id)
	{
		$this->employee_dao->delete(new Employee(['id' => $id]));
	}

	public function addEmployee(array $data)
	{
		$this->employee = new Employee($data);
		$this->validateEmployee($this->employee);
		if (!$this->hasErrors()) {
			$this->employee_dao->add($this->employee);
			return true;
		}
		return false;
	}

	public function editEmployee(array $data)
	{
		$this->employee  = new Employee($data);
		$this->validateEmployee($this->employee);
		if (!$this->hasErrors()) {
			$this->employee_dao->edit($this->employee);
		}
	}

	public function validateEmployee(Employee $employee)
	{
		if ($employee->first_name == null || !strlen($employee->first_name)) {
			$this->addError('Имя обязательно');
		}

		if ($employee->last_name == null || !strlen($employee->last_name)) {
			$this->addError('Фамилия обязательна');
		}

		if ($employee->position == null || !$employee->position) {
			$this->addError('Должность обязательна');
		}

		if ($employee->salary == null && !(int)$employee->salary) {
			$this->addError('Оклад должен быть положительным целым числом');
		}
	}

	public function getErrors()
	{
		return $this->errors;
	}

	public function addError($error)
	{
		$this->errors[] = $error;
	}

	public function hasErrors()
	{
		return count($this->errors) > 0;
	}

}