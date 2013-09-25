<?php

namespace PHPEmployeeList\Model;


use PHPEmployeeList\Model\Domain\Employee;

interface EmployeeListModel
{

	/**
	 * @return Employee[]
	 */
	public function getEmployees();

}