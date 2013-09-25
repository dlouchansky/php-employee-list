<?

namespace PHPEmployeeList;

function employee_list_autoload($className)
{

	$className = ltrim($className, '\\');
	$fileName  = '';
	if ($lastNsPos = strrpos($className, '\\')) {
		$namespace = substr($className, 0, $lastNsPos);
		$className = substr($className, $lastNsPos + 1);
		$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
	}
	$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
	require '../'.$fileName;

}

spl_autoload_register('PHPEmployeeList\employee_list_autoload');

$router = new Router($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);
$router->navigate();