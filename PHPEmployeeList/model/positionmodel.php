<?php

namespace PHPEmployeeList\Model;


use PHPEmployeeList\Model\Domain\Position;
use PHPEmployeeList\Model\Persistence\PositionDAO;

class PositionModel implements SinglePositionModel, PositionListModel
{

	private $position_dao;
	private $position;
	private $errors = [];

	public function __construct(PositionDAO $position_dao) {
		$this->position_dao = $position_dao;
	}

	public function getPositions()
	{
		return $this->position_dao->getAll();
	}

	public function deletePosition($id)
	{
		$this->position_dao->delete(new Position(['id' => $id]));
	}

	public function addPosition(array $data)
	{
		$this->position = new Position($data);
		$this->validatePosition($this->position);
		if (!$this->hasErrors()) {
			$this->position_dao->add($this->position);
			return true;
		}
		return false;
	}

	public function editPosition(array $data)
	{
		$this->position = new Position($data);
		$this->validatePosition($this->position);
		if (!$this->hasErrors()) {
			$this->position_dao->edit($this->position);
		}
	}

	public function getPosition($id = null)
	{
		if ($id != null)
			return $this->position_dao->get($id);

		if ($this->position != null)
			return $this->position;

		return new Position([]);
	}

	public function setPosition($id)
	{
		$this->position = $this->position_dao->get($id);
	}

	public function validatePosition(Position $position)
	{
		if ($position->name == null || !strlen($position->name)) {
			$this->addError('Название обязательно');
		}
	}

	public function getErrors()
	{
		return $this->errors;
	}

	public function addError($error)
	{
		$this->errors[] = $error;
	}

	public function hasErrors()
	{
		return count($this->errors) > 0;
	}
}