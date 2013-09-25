<?php

namespace PHPEmployeeList\View\Employee;


use PHPEmployeeList\Model\EmployeeListModel;
use PHPEmployeeList\View\BaseView;

class EmployeeListView extends BaseView
{

	private $model;

	private $employees;

	public function __construct(EmployeeListModel $employee_model)
	{
		$this->model = $employee_model;
		$this->employees = $this->model->getEmployees();
	}

	public function showHtml($uri_params)
	{
		include "tpl/employee.list.html.php";
	}

	public function showJson($uri_params)
	{

	}

}