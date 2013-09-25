<?php

namespace PHPEmployeeList\Model;


use PHPEmployeeList\Model\Domain\Employee;
use PHPEmployeeList\Model\Domain\Position;

interface SingleEmployeeModel
{

	/**
	 * @return string[]
	 */
	public function getErrors();

	/**
	 * @return Position[]
	 */
	public function getPositions();

	/**
	 * @return Employee
	 */
	public function getEmployee();

}