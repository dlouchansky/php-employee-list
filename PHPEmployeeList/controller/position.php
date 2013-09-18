<?php

namespace PHPEmployeeList\Controller;

use \PHPEmployeeList\Model\Positions;
use \PHPEmployeeList\Config;

class Position extends Controller
{

	public function getList()
	{
		$this->data['positions'] = Positions::getList();
		$this->show('position.list');
	}

	public function edit($id)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$fields = $this->getPostFields(Positions::$fields);
			$this->data['errors'] = Positions::validate($fields);

			if (!count($this->data['errors'])) {
				Positions::edit($id, $fields);
				header('Location: '.Config::$root.'/index.php/position');
				return false;
			} else {
				$this->data['position'] = $_POST;
			}
		} else {
			$this->data['position'] = Positions::get($id);
		}

		$this->Show('position.edit');
	}

	public function add()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$fields = $this->getPostFields(Positions::$fields);
			$this->data['errors'] = Positions::validate($fields);

			if (!count($this->data['errors'])) {
				Positions::add($fields);
				header('Location: '.Config::$root.'/index.php/position');
				return false;
			} else {
				$this->data['position'] = $_POST;
			}
		}

		$this->show('position.add');
	}

	public function delete($id)
	{
		Positions::delete($id);
		header('Location: ' . Config::$root . '/index.php/position');
	}

}