<?php
require_once('controller.php');
require_once('../model/positions.php');

class Position extends Controller {

	public function GetList() {
		$this->data['positions'] = Positions::GetList();
		$this->Show('position.list');
	}

	public function Edit($id) {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->data['errors'] = array();

			if (!isset($_POST['name']) || !strlen($_POST['name'])) {
				$this->data['errors'][] = 'Название обязательно';
			}

			if (!count($this->data['errors'])) {
				Positions::Edit($id, $this->GetPostFields(Positions::$fields));
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
			$this->data['errors'] = array();

			if (!isset($_POST['name']) || !strlen($_POST['name'])) {
				$this->data['errors'][] = 'Название обязательно';
			}

			if (!count($this->data['errors'])) {
				Positions::Add($this->GetPostFields(Positions::$fields));
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