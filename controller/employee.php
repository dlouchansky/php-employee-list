<?
require_once('controller.php');
require_once('../model/employees.php');

class Employee extends Controller {

	public function GetList($field = '', $direction = '') {
		if (strlen($field) && array_key_exists($field, Employees::$fields)) {
			if ($field == 'position')
				$field = 'pos_name';

			$this->data['employees'] = Employees::GetList($field, $direction);
		}
		else {
			$this->data['employees'] = Employees::GetList();
		}
		$this->Show('employee.list');
	}

	public function Edit($id) {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->data['errors'] = array();

			if (!isset($_POST['first_name']) || !strlen($_POST['first_name'])) {
				$this->data['errors'][] = 'Имя обязательно';
			}

			if (!isset($_POST['last_name']) || !strlen($_POST['last_name'])) {
				$this->data['errors'][] = 'Фамилия обязательна';
			}

			if (!isset($_POST['position']) || !$_POST['position']) {
				$this->data['errors'][] = 'Должность обязательна';
			}

			if (isset($_POST['salary']) && !(int)$_POST['salary']) {
				$this->data['errors'][] = 'Оклад должен быть положительным целым числом';
			}

			if (!count($this->data['errors'])) {
				Employees::Edit($id, $this->GetPostFields(Employees::$fields));
				header('Location: '.Config::$root.'/index.php/employee');
				return false;
			} else {
				$this->data['employee'] = $_POST;
			}
		} else {
			$this->data['employee'] = Employees::Get($id);
		}

		$this->data['positions'] = Positions::GetList();

		$this->Show('employee.edit');
	}

	public function Add() {

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->data['errors'] = array();

			if (!isset($_POST['first_name']) || !strlen($_POST['first_name'])) {
				$this->data['errors'][] = 'Имя обязательно';
			}

			if (!isset($_POST['last_name']) || !strlen($_POST['last_name'])) {
				$this->data['errors'][] = 'Фамилия обязательна';
			}

			if (!isset($_POST['position']) || !$_POST['position']) {
				$this->data['errors'][] = 'Должность обязательна';
			}

			if (isset($_POST['salary']) && !(int)$_POST['salary']) {
				$this->data['errors'][] = 'Оклад должен быть положительным целым числом';
			}

			if (!count($this->data['errors'])) {
				Employees::Add($this->GetPostFields(Employees::$fields));
				header('Location: '.Config::$root.'/index.php/employee');
				return false;
			} else {
				$this->data['employee'] = $_POST;
			}
		}

		$this->data['positions'] = Positions::GetList();

		$this->Show('employee.add');
	}

	public function Delete($id) {
		Employees::Delete($id);
		header('Location: '.Config::$root.'/index.php/employee');
	}

}