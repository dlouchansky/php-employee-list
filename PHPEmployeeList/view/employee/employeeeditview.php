<?php

namespace PHPEmployeeList\View\Employee;

use PHPEmployeeList\Model\SingleEmployeeModel;
use PHPEmployeeList\View\BaseView;

class EmployeeEditView extends BaseView
{

	private $model;

	public function __construct(SingleEmployeeModel $employee_model)
	{
		$this->model = $employee_model;
		$this->employee = $this->model->getEmployee();
		$this->positions = $this->model->getPositions();
		$this->errors = $this->model->getErrors();
	}

	public function showHtml($uri_params)
	{
		include "tpl/employee.edit.html.php";
	}

	public function showJson($uri_params)
	{

	}

}