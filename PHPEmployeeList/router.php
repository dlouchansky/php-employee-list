<?php

namespace PHPEmployeeList;

use PHPEmployeeList\Model\Persistence\PDOEmployeeDAO;
use PHPEmployeeList\Model\EmployeeModel;
use PHPEmployeeList\Model\Persistence\PDOPositionDAO;
use PHPEmployeeList\Model\PositionModel;

class Router
{

	private $uri;
	private $method;

	public function __construct($uri, $method)
	{
		$this->uri = substr($uri, strlen(Config::base()));
		$this->method = $method == "POST" ? "POST" : "GET";
	}

	public function navigate()
	{

		$uri_params = strlen($this->uri) ? explode('/', $this->uri) : array();

		$mode = "html";
		if ($uri_params && $uri_params[0] == "ajax") {
			$mode = "ajax";
			array_shift($uri_params);
		}

		$uri_controller = array_shift($uri_params);
		if ($uri_controller == "employee") {

			$model = new EmployeeModel(new PDOEmployeeDAO(), new PDOPositionDAO());
			$controller = new Controller\EmployeeController($model);

			if ($uri_params[0] == 'add')
				$view = new View\Employee\EmployeeAddView($model);
			else if ($uri_params[0] == 'edit')
				$view = new View\Employee\EmployeeEditView($model);
			else
				$view = new View\Employee\EmployeeListView($model);

		}
		else if ($uri_controller == "position") {
			$model = new PositionModel(new PDOPositionDAO());
			$controller = new Controller\PositionController($model);

			if ($uri_params[0] == 'add')
				$view = new View\Position\PositionAddView($model);
			else if ($uri_params[0] == 'edit')
				$view = new View\Position\PositionEditView($model);
			else
				$view = new View\Position\PositionListView($model);
		} else {
			$controller = new Controller\MainController();
			$view = new View\EmptyView();
		}

		$controller->execute($this->method, $uri_params);
		$view->output($mode, $uri_params);
	}

}