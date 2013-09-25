<?php

namespace PHPEmployeeList\Model;


use PHPEmployeeList\Model\Domain\Position;

interface SinglePositionModel
{

	/**
	 * @return Position
	 */
	public function getPosition();

	/**
	 * @return string[]
	 */
	public function getErrors();

}