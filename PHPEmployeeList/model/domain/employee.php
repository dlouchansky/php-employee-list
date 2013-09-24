<?php

namespace PHPEmployeeList\Model\Domain;

/**
 * Class Employee
 * @package PHPEmployeeList\Model\Domain
 */
class Employee
{
	private static $field_types = [
		'id' => 'int',
		'first_name' => 'string',
		'last_name' => 'string',
		'salary' => 'int',
		'position' => 'int',
		'description' => 'string',
	];

	private $data = [
		'id', 'first_name', 'last_name', 'description', 'salary', 'position'
	];

	public function __construct(array $data)
	{
		foreach($this->data as $field) {
			if (isset($data[$field]) && $this->getFieldType($field) == 'int') {
				$this->$field = $data[$field];
			}
			else if (isset($data[$field])) {
				$this->$field = $data[$field];
			}
			else
				$this->$field = '';

			$this->$field = strip_tags($this->$field);
		}
	}

	/**
	 * @param string $name
	 * @return mixed|null
	 */
	public function __get($name)
	{
		if (array_key_exists($name, $this->data)) {
			return $this->data[$name];
		}
		return null;
	}

	/**
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
	public function __set($name, $value)
	{
		$this->data[$name] = $value;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return "Employee ID: " . $this->id . ". Name: " . $this->first_name . " " . $this->last_name . ".";
	}

	/**
	 * @param string $field
	 * @return string mixed|null
	 */
	public static function getFieldType($field)
	{
		if (array_key_exists($field, self::$field_types)) {
			return self::$field_types[$field];
		}
		return null;
	}

}