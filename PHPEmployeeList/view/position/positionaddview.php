<?php

namespace PHPEmployeeList\View\Position;

use PHPEmployeeList\Model\SinglePositionModel;
use PHPEmployeeList\View\BaseView;

class PositionAddView extends BaseView
{

	private $model;

	private $position;
	private $errors;

	public function __construct(SinglePositionModel $position_model)
	{
		$this->model = $position_model;
		$this->position = $this->model->getPosition();
		$this->errors = $this->model->getErrors();
	}

	public function showHtml($uri_params)
	{
		include "tpl/position.add.html.php";
	}

	public function showJson($uri_params)
	{

	}

}