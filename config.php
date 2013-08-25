<?

class Config {

	public static function DB() {
		return array(
			'host' => 'localhost',
			'user' =>  'employee_list',
			'pass' => 'password',
			'database' => 'eployee_list',
			'port' => 3306
		);
	}

	public static $root = '/php_employee_list';
}
