<?php

namespace PHPEmployeeList\Model;


use PHPEmployeeList\Model\Domain\Position;

interface PositionListModel
{

	/**
	 * @return Position[]
	 */
	public function getPositions();

}