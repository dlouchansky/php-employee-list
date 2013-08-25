<?
require_once('controller.php');
require_once('model/employees.php');

class Employee extends Controller {

	public static function GetList($field = '', $direction = '') {
		if (strlen($field) && array_key_exists($field, Employees::$fields)) {
			if ($field == 'position')
				$field = 'pos_name';

			self::$data['employees'] = DB::GetList('employees', array(
				'order' => $field.' '.$direction,
				'join' => 'positions',
				'on' => 'positions.id = employees.position',
				'join_fields' => 'positions.id as pos_id, positions.description as pos_desc, positions.name as pos_name'
			));
		}
		else
			self::$data['employees'] = DB::GetList('employees', array(
				'order' => 'name ASC',
				'join' => 'positions',
				'on' => 'positions.id = employees.position',
				'join_fields' => 'positions.id as pos_id, positions.description as pos_desc, positions.name as pos_name'
			));
		self::Show('employee.list');
	}

	public static function Edit($id) {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			self::$data['errors'] = array();

			if (!isset($_POST['first_name']) || !strlen($_POST['first_name'])) {
				self::$data['errors'][] = 'Имя обязательно';
			}

			if (!isset($_POST['last_name']) || !strlen($_POST['last_name'])) {
				self::$data['errors'][] = 'Фамилия обязательна';
			}

			if (!isset($_POST['position']) || !$_POST['position']) {
				self::$data['errors'][] = 'Должность обязательна';
			}

			if (isset($_POST['salary']) && !(int)$_POST['salary']) {
				self::$data['errors'][] = 'Оклад должен быть положительным целым числом';
			}

			if (!count(self::$data['errors'])) {
				DB::Edit('employees', $id, self::GetPostFields(Employees::$fields));
				return header('Location: '.Config::$root.'/index.php/employee');
			} else {
				self::$data['employee'] = $_POST;
			}
		} else {
			self::$data['employee'] = DB::Get('employees', $id);
		}

		self::$data['positions'] = DB::GetList('positions');

		self::Show('employee.edit');
	}

	public static function Add() {

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			self::$data['errors'] = array();

			if (!isset($_POST['first_name']) || !strlen($_POST['first_name'])) {
				self::$data['errors'][] = 'Имя обязательно';
			}

			if (!isset($_POST['last_name']) || !strlen($_POST['last_name'])) {
				self::$data['errors'][] = 'Фамилия обязательна';
			}

			if (!isset($_POST['position']) || !$_POST['position']) {
				self::$data['errors'][] = 'Должность обязательна';
			}

			if (isset($_POST['salary']) && !(int)$_POST['salary']) {
				self::$data['errors'][] = 'Оклад должен быть положительным целым числом';
			}

			if (!count(self::$data['errors'])) {
				DB::Add('employees', self::GetPostFields(Employees::$fields));
				return header('Location: '.Config::$root.'/index.php/employee');
			} else {
				self::$data['employee'] = $_POST;
			}
		}

		self::$data['positions'] = DB::GetList('positions');


		self::Show('employee.add');
	}

	public static function Delete($id) {
		DB::Delete('employees', $id);
		return header('Location: '.Config::$root.'/index.php/employee');
	}

}