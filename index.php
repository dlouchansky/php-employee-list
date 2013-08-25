<?
require_once('config.php');
require_once('model/db.php');

require_once('employee.php');
require_once('position.php');


class Router {

	public function __construct() {
		$this->Navigate($this->PrepareUri());
	}

	public function PrepareUri() {
		$uri = $_SERVER["REQUEST_URI"];

		if ($len = strlen(Config::$root))
			$uri = substr($uri, $len);

		$uri = substr($uri, strlen('/index.php/')); // strlen just for clearness
		$params = strlen($uri) ? explode('/', $uri) : array();

		return $params;
	}

	public function Navigate(array $params) {
		if (count($params)) {

			if ($params[0] == 'employee') {
				if (!isset($params[1]))
					Employee::GetList();

				else if ($params[1] == 'add') {
					Employee::Add();
				} else if ($params[1] == 'edit' && isset($params[2]) && $id = (int)$params[2]) {
					Employee::Edit($id);
				} else if ($params[1] == 'delete' && isset($params[2]) && $id = (int)$params[2]) {
					Employee::Delete($id);
				} else if ($params[1] == 'list' && isset($params[2]) && isset($params[3]) && ($field = $params[2]) && in_array($direction = $params[3], array('asc', 'desc'))) {
					Employee::GetList($field, $direction);
				} else {
					Employee::GetList();
				}
			}
			else if ($params[0] == 'position') {
				if (!isset($params[1]))
					Position::GetList();

				else if ($params[1] == 'add') {
					Position::Add();
				} else if ($params[1] == 'edit' && isset($params[2]) && $id = (int)$params[2]) {
					Position::Edit($id);
				} else if ($params[1] == 'delete' && isset($params[2]) && $id = (int)$params[2]) {
					Position::Delete($id);
				} else {
					Position::GetList();
				}
			}

		} else {
			Controller::Show();
		}
	}
}

new Router();

