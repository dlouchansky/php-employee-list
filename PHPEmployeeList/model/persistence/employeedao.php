<?php

namespace PHPEmployeeList\Model\Persistence;

use PHPEmployeeList\Model\Domain\Employee;

/**
 * Class EmployeeDAO
 * @package PHPEmployeeList\Model\DB
 */
interface EmployeeDAO
{

	/**
	 * @param string $order_field
	 * @param string $order_direction
	 * @return Employee[]
	 */
	public function getAll($order_field = "id", $order_direction = "asc");

	/**
	 * @param Employee $employee
	 * @return bool
	 */
	public function edit(Employee $employee);

	/**
	 * @param int $employee_id
	 * @return Employee
	 */
	public function get($employee_id);

	/**
	 * @param Employee $employee
	 * @return Employee $employee
	 */
	public function add(Employee $employee);

	/**
	 * @param Employee $employee
	 * @return bool
	 */
	public function delete(Employee $employee);

}