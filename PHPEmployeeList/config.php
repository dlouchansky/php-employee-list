<?

namespace PHPEmployeeList;

class Config
{

	public static function PDO()
	{
		return array(
			'dbtype' => 'mysql',
			'host' => 'localhost',
			'user' =>  'employee_list',
			'pass' => 'password',
			'database' => 'employee_list',
			'port' => 3306
		);
	}

	public static $root = '/phpemployeelist/';
	public static $index = 'index.php/';

	public static function base() { return self::$root.self::$index; }

}
