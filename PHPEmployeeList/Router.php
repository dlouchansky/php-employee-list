<?php

namespace PHPEmployeeList;

class Router {

	private $params;

	public function prepareUri($uri)
	{
		if ($len = strlen(Config::$root))
			$uri = substr($uri, $len);

		$uri = substr($uri, strlen('/index.php/')); // strlen just for clearness
		$this->params = strlen($uri) ? explode('/', $uri) : array();

	}

	protected function matchController($controller_name)
	{
		switch ($controller_name) {
			case "employee":
				$controller = new Controller\Employee();
				break;
			case "position":
				$controller = new Controller\Position();
				break;
			default:
				$controller = new Controller\Employee();
		}

		return $controller;
	}


	public function navigate()
	{
		if (!isset($this->params)) {
			throw new \ErrorException("prepare uri first");
		}

		if (!count($this->params)) {
			(new Controller\Controller)->show();
		} else {
			$controller_name = $this->params[0];
			$controller = $this->matchController($controller_name);

			if (!isset($this->params[1])) {
				$controller->getList();
			} else if ($this->params[1] == 'add') {
				$controller->add();
			} else if ($this->params[1] == 'edit' && isset($this->params[2]) && $id = (int)$this->params[2]) {
				$controller->edit($id);
			} else if ($this->params[1] == 'delete' && isset($this->params[2]) && $id = (int)$this->params[2]) {
				$controller->delete($id);
			} else if (
				$this->params[1] == 'list' && isset($this->params[2]) &&
				isset($this->params[3]) && ($field = $this->params[2]) &&
				in_array($direction = $this->params[3], array('asc', 'desc')) &&
				$controller instanceof Controller\Employee
			) {
				$controller->getList($field, $direction);
			} else {
				$controller->getList();
			}

		}
	}
}