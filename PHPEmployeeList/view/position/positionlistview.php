<?php

namespace PHPEmployeeList\View\Position;


use PHPEmployeeList\Model\PositionModel;
use PHPEmployeeList\View\BaseView;

class PositionListView extends BaseView
{

	private $model;

	public function __construct(PositionModel $position_model)
	{
		$this->model = $position_model;
	}

	public function showHtml($uri_params)
	{
		include "tpl/position.list.html.php";
	}

	public function showJson($uri_params)
	{

	}

}