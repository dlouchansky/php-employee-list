<?php

namespace PHPEmployeeList\Controller;

use PHPEmployeeList\Config;
use PHPEmployeeList\Model\PositionModel;

class PositionController implements Controller
{
	private $position_model;

	public function __construct(PositionModel $_position_model) {
		$this->position_model = $_position_model;
	}

	public function execute($http_method, $uri_params)
	{
		if (in_array($uri_params[0], array('add', 'edit', 'delete'))) {
			$method = array_shift($uri_params);
			$this->$method($uri_params, $http_method);
		}
	}

	public function edit($uri_params, $method)
	{
		if (!$uri_params || !$id = (int)$uri_params[0])
			throw new \ErrorException("id in url is required");

		if ($method == 'POST') {
			if (!isset($_POST['id']) || !$id = (int)$_POST['id'])
				throw new \ErrorException("id is required");

			$this->position_model->editPosition($_POST);
		} else {
			$this->position_model->setPosition($id);
		}
	}

	public function add($uri_params, $method)
	{
		if ($method == 'POST') {
			if ($this->position_model->addPosition($_POST))
				header("Location: ".Config::base()."position/getList");
		}
	}

	public function delete($uri_params, $method)
	{
		if ($method == 'POST') {
			if (!isset($_POST['id']) || !$id = (int)$_POST['id'])
				throw new \ErrorException("id is required");

			$this->position_model->deletePosition($id);
		}

		header("Location: ".Config::base()."position/getList");
	}

}