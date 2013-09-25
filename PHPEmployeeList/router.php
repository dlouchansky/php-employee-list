<?php

namespace PHPEmployeeList;

use PHPEmployeeList\Controller\Controller;
use PHPEmployeeList\View\View;
use ReflectionClass;

class DependencyContainer
{
	private static $inst;

	public static function getInstance() {
		if (self::$inst == null)
			self::$inst = new DependencyContainer();

		return self::$inst;
	}

	private $constructor_dependencies = [
		'Model\EmployeeModel' => ['Model\Persistence\PDOEmployeeDAO', 'Model\Persistence\PDOPositionDAO'],
		'Model\PositionModel' => ['Model\Persistence\PDOPositionDAO'],
		'Controller\EmployeeController' => ['Model\EmployeeModel'],
		'Controller\PositionController' => ['Model\PositionModel'],
		'View\Employee\EmployeeAddView' => ['Model\EmployeeModel'],
		'View\Employee\EmployeeEditView' => ['Model\EmployeeModel'],
		'View\Employee\EmployeeListView' => ['Model\EmployeeModel'],
		'View\Position\PositionAddView' => ['Model\PositionModel'],
		'View\Position\PositionEditView' => ['Model\PositionModel'],
		'View\Position\PositionListView' => ['Model\PositionModel'],
	];

	private $dependencies = [];

	public function constructComponent($component_name) {
		if (isset($this->dependencies[$component_name]))
			return $this->dependencies[$component_name];

		$class_name = "PHPEmployeeList\\" . $component_name;
		$reflect = new ReflectionClass($class_name);

		$constructor = $reflect->getConstructor();
		if ($constructor != null) {
			$constructor_parameters = $constructor->getParameters();
		} else {
			$constructor_parameters = [];
		}

		if (count($constructor_parameters)) {
			$component_resources = $this->constructor_dependencies[$component_name];
			$resources = [];
			foreach ($component_resources as $res) {
				$resources[] = $this->constructComponent($res);
			}
			$this->dependencies[$component_name] = $reflect->newInstanceArgs($resources);
		} else {
			$this->dependencies[$component_name] = $reflect->newInstance();
		}

		return $this->dependencies[$component_name];
	}
}

class Router
{
	private $uri;
	private $method;
	private $mode;
	private $uri_params;

	private $routes = [
		['uri' => ['employee', 'add'], 'components' => ['controller' => 'Controller\EmployeeController', 'view' => 'View\Employee\EmployeeAddView']],
		['uri' => ['employee', 'edit'], 'components' => ['controller' => 'Controller\EmployeeController', 'view' => 'View\Employee\EmployeeEditView']],
		['uri' => ['employee', ''], 'components' => ['controller' => 'Controller\EmployeeController', 'view' => 'View\Employee\EmployeeListView']],

		['uri' => ['position', 'add'], 'components' => ['controller' => 'Controller\PositionController', 'view' => 'View\Position\PositionAddView']],
		['uri' => ['position', 'edit'], 'components' => ['controller' => 'Controller\PositionController', 'view' => 'View\Position\PositionEditView']],
		['uri' => ['position', ''], 'components' => ['controller' => 'Controller\PositionController', 'view' => 'View\Position\PositionListView']],

		['uri' => [''], 'components' => ['controller' => 'Controller\MainController', 'view' => 'View\EmptyView']]
	];

	public function __construct($uri, $method)
	{
		$this->uri = $uri;
		$this->method = $method == "POST" ? "POST" : "GET";
	}

	public function navigate()
	{
		$this->uri = substr($this->uri, strlen(Config::base()));
		$this->uri_params = strlen($this->uri) ? explode('/', $this->uri) : array();

		$this->mode = "html";
		if ($this->uri_params && $this->uri_params[0] == "ajax") {
			$this->mode = "ajax";
			$this->uri_params = array_slice($this->uri_params, 1);
		}

		foreach ($this->routes as $route) {
			$uri = $route['uri'];

			if (count($uri) == 1) {
				$this->constructComponents($route['components']);
				break;
			}

			if ($this->uri_params && $uri[0] == $this->uri_params[0] && $uri[1] == '') {
				$this->uri_params = array_slice($this->uri_params, 1);
				$this->constructComponents($route['components']);
				break;
			}

			if (count($this->uri_params) > 1 && $uri[0] == $this->uri_params[0] && $uri[1] == $this->uri_params[1]) {
				$this->uri_params = array_slice($this->uri_params, 1);
				$this->constructComponents($route['components']);
				break;
			}
		}
	}

	public function constructComponents($components)
	{
		$controller_name = $components['controller'];
		$view_name = $components['view'];

		$controller = DependencyContainer::getInstance()->constructComponent($controller_name);
		$view = DependencyContainer::getInstance()->constructComponent($view_name);

		if ($controller instanceof Controller && $view instanceof View) {
			$controller->execute($this->method, $this->uri_params);
			$view->output($this->mode, $this->uri_params);
		}
	}

}