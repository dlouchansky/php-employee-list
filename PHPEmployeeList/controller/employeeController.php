<?

namespace PHPEmployeeList\Controller;

use PHPEmployeeList\Config;
use \PHPEmployeeList\Model\EmployeeModel;

class EmployeeController implements Controller
{

	private $employee_model;

	public function __construct(EmployeeModel $_employee_model) {
		$this->employee_model = $_employee_model;
	}

	public function execute($http_method, $uri_params)
	{
		if (in_array($uri_params[0], array('add', 'edit', 'delete', 'getList'))) {
			$method = array_shift($uri_params);
			$this->$method($uri_params, $http_method);
		}
	}

	public function getList($uri_params, $method)
	{
		$field = array_shift($uri_params);
		$order = array_shift($uri_params);

		$this->employee_model->filterEmployees($field ?: "", $order ?: "");
	}

	public function edit($uri_params, $method)
	{
		if (!$uri_params || !$id = (int)$uri_params[0])
			throw new \ErrorException("id in url is required");

		if ($method == 'POST') {
			if (!isset($_POST['id']) || !$id = (int)$_POST['id'])
				throw new \ErrorException("id is required");

			$this->employee_model->editEmployee($_POST);
		} else {
			$this->employee_model->setEmployee($id);
		}
	}

	public function add($uri_params, $method)
	{
		if ($method == 'POST') {
			if ($this->employee_model->addEmployee($_POST))
				header("Location: ".Config::base()."employee/getList");
		}
	}

	public function delete($uri_params, $method)
	{
		if ($method == 'POST') {
			if (!isset($_POST['id']) || !$id = (int)$_POST['id'])
				throw new \ErrorException("id is required");

			$this->employee_model->deleteEmployee($id);
		}

		header("Location: ".Config::base()."employee/getList");
	}

}