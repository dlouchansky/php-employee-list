<?

namespace PHPEmployeeList\Controller;

use \PHPEmployeeList\Model\Employees;
use \PHPEmployeeList\Model\Positions;
use \PHPEmployeeList\Config;

class Employee extends Controller
{

	public function getList($field = '', $direction = '')
	{
		if (strlen($field) && array_key_exists($field, Employees::$fields)) {
			if ($field == 'position')
				$field = 'pos_name';

			$this->data['employees'] = Employees::getList($field, $direction);
		}
		else {
			$this->data['employees'] = Employees::getList();
		}
		$this->show('employee.list');
	}

	public function edit($id)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$fields = $this->getPostFields(Employees::$fields);
			$this->data['errors'] = Employees::validate($fields);

			if (!count($this->data['errors'])) {
				Employees::edit($id, $fields);
				header('Location: '.Config::$root.'/index.php/employee');
				return false;
			} else {
				$this->data['employee'] = $_POST;
			}
		} else {
			$this->data['employee'] = Employees::get($id);
		}

		$this->data['positions'] = Positions::getList();

		$this->Show('employee.edit');
	}

	public function add()
	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$fields = $this->getPostFields(Employees::$fields);
			$this->data['errors'] = Employees::validate($fields);

			if (!count($this->data['errors'])) {
				Employees::add($fields);
				header('Location: '.Config::$root.'/index.php/employee');
				return false;
			} else {
				$this->data['employee'] = $_POST;
			}
		}

		$this->data['positions'] = Positions::getList();

		$this->show('employee.add');
	}

	public function delete($id) {
		Employees::delete($id);
		header('Location: ' . Config::$root . '/index.php/employee');
	}

}