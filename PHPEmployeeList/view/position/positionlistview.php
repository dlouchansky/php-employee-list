<?php

namespace PHPEmployeeList\View\Position;

use PHPEmployeeList\Model\PositionListModel;
use PHPEmployeeList\View\BaseView;

class PositionListView extends BaseView
{

	private $model;

	private $positions;

	public function __construct(PositionListModel $position_model)
	{
		$this->model = $position_model;
		$this->positions = $this->model->getPositions();
	}

	public function showHtml($uri_params)
	{
		include "tpl/position.list.html.php";
	}

	public function showJson($uri_params)
	{

	}

}