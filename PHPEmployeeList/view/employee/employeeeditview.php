<?php

namespace PHPEmployeeList\View\Employee;


use PHPEmployeeList\Model\EmployeeModel;
use PHPEmployeeList\View\BaseView;

class EmployeeEditView extends BaseView
{

	private $model;

	public function __construct(EmployeeModel $employee_model)
	{
		$this->model = $employee_model;
	}

	public function showHtml($uri_params)
	{
		include "tpl/employee.edit.html.php";
	}

	public function showJson($uri_params)
	{

	}

}