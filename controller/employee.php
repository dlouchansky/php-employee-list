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
			$fields = $this->GetPostFields(Employees::$fields);
			$this->data['errors'] = Employees::Validate($fields);

			if (!count($this->data['errors'])) {
				Employees::Edit($id, $fields);
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

			$fields = $this->GetPostFields(Employees::$fields);
			$this->data['errors'] = Employees::Validate($fields);

			if (!count($this->data['errors'])) {
				Employees::Add($fields);
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