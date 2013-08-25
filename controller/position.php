<?php
require_once('controller.php');
require_once('./model/positions.php');

class Position extends Controller {

	public function GetList() {
		$this->data['positions'] = Positions::GetList();
		$this->Show('position.list');
	}

	public function Edit($id) {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$fields = $this->GetPostFields(Positions::$fields);
			$this->data['errors'] = Positions::Validate($fields);

			if (!count($this->data['errors'])) {
				Positions::Edit($id, $fields);
				header('Location: '.Config::$root.'/index.php/position');
				return false;
			} else {
				$this->data['position'] = $_POST;
			}
		} else {
			$this->data['position'] = Positions::Get($id);
		}

		$this->Show('position.edit');
	}

	public function Add() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$fields = $this->GetPostFields(Positions::$fields);
			$this->data['errors'] = Positions::Validate($fields);

			if (!count($this->data['errors'])) {
				Positions::Add($fields);
				header('Location: '.Config::$root.'/index.php/position');
				return false;
			} else {
				$this->data['position'] = $_POST;
			}
		}

		$this->Show('position.add');
	}

	public function Delete($id) {
		Positions::Delete($id);
		header('Location: '.Config::$root.'/index.php/position');
	}

}