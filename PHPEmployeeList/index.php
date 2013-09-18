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

$router = new Router();
$router->prepareUri($_SERVER["REQUEST_URI"]);
$router->navigate();

// TODO create Template class to load view files through it
// TODO rename current models to some "Services" and retrieve data from BD not as arrays but as objects
// TODO DI using Composer to remove all these static methods in models
